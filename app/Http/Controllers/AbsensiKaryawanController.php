<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AbsensiKaryawan;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Exports\AbsensiKaryawanExport;
use Illuminate\Contracts\Session\Session;
use Maatwebsite\Excel\Facades\Excel;

class AbsensiKaryawanController extends Controller{

    public function absensiPage(){
        //cek apakah karyawan sudah absen masuk dan absen keluar hari ini
        $userId = session('user_id');
        $date_only = Carbon::now()->toDateString();
        $today_absensi = AbsensiKaryawan::where('id_karyawan', $userId)->where('tanggal_absensi', $date_only)->first();
        $sudah_absen_masuk = $today_absensi && $today_absensi->jam_masuk ? true : false;
        $sudah_absen_keluar = $today_absensi && $today_absensi->jam_keluar ? true : false;

        // atur jam kerja 08:00 - 17:00 (tanggal disesuaikan ke hari ini)
        // gunakan Carbon::today()->setTime agar tanggalnya konsisten (hari ini) dan waktu tetap
        $jam_masuk_kerja = Carbon::today()->setTime(8, 0, 0)->format('H:i');
        $jam_keluar_kerja = Carbon::today()->setTime(17, 0, 0)->format('H:i');
        $sekarang = Carbon::now()->format('H:i');
        $tanggal = Carbon::now()->format('d-m-Y');

        return view('karyawan.absensiPage', compact('sudah_absen_masuk','sudah_absen_keluar','jam_masuk_kerja','jam_keluar_kerja','sekarang','tanggal'));

    }
    public function absensiIzin(){
        return view('karyawan.absensiIzin');
    }
    public function absensiSakit(){
        return view('karyawan.absensiSakit');
    }
    public function historyAbsensiMaster(Request $request){
        //ambil semua data histori absensi untuk semua karyawan
        $filter_type = $request->get('filter_type', null); // 'week' or 'month'
        $filter_value = $request->get('filter_value', null); // e.g. '2023-05' for month or '2023-W20' for week
        $query = AbsensiKaryawan::join('profile_karyawan', 'absensi_karyawan.id_karyawan', '=', 'profile_karyawan.id')
                ->select('absensi_karyawan.*','profile_karyawan.nama_lengkap as nama_karyawan')
                ->orderBy('tanggal_absensi','desc');

        // Apply filters using reliable date ranges to avoid WEEKOFYEAR/year edge cases
        if ($filter_type && $filter_value) {
            try {
                if ($filter_type === 'month') {
                    // Expecting format YYYY-MM from <input type="month">
                    $start = Carbon::createFromFormat('Y-m', $filter_value)->startOfMonth();
                    $end = (clone $start)->endOfMonth();
                    $query->whereBetween('tanggal_absensi', [$start->toDateString(), $end->toDateString()]);
                } else if ($filter_type === 'week') {
                    // Expecting format like YYYY-Www from <input type="week"> (e.g. 2025-W49)
                    if (preg_match('/^(\d{4})-W?(\d{1,2})$/', $filter_value, $m)) {
                        $year = (int)$m[1];
                        $week = (int)$m[2];
                        // setISODate: sets date to first day (Monday) of ISO week
                        $monday = Carbon::now()->setISODate($year, $week)->startOfWeek();
                        $sunday = (clone $monday)->endOfWeek();
                        $query->whereBetween('tanggal_absensi', [$monday->toDateString(), $sunday->toDateString()]);
                    }
                }
            } catch (\Exception $e) {
                // If parsing fails, silently ignore filter to avoid breaking the page
            }
        }

        // Clone query builder before paginating so each paginator uses a fresh query
        $queryDesktop = (clone $query);
        $queryMobile = (clone $query);

        $fetch_data_absensi_karyawan_desktop = $queryDesktop->paginate(5);
        $fetch_data_absensi_karyawan_mobile = $queryMobile->paginate(2);

        // Append query parameters for pagination links
        $fetch_data_absensi_karyawan_desktop->appends($request->all());
        $fetch_data_absensi_karyawan_mobile->appends($request->all());

    // If filtering by month/week and no results, try to fetch the next period's data.
    $used_next_month = false;
    $requested_filter_value = $filter_value;
    $shown_filter_value = $filter_value;
    $no_data_next_month = false;

    $used_next_week = false;
    $requested_filter_value_week = $filter_value;
    $shown_filter_value_week = $filter_value;
    $no_data_next_week = false;

    if ($filter_type === 'month' && $filter_value && $fetch_data_absensi_karyawan_desktop->total() == 0) {
            try {
                $requestedStart = Carbon::createFromFormat('Y-m', $filter_value)->startOfMonth();
                $nextStart = (clone $requestedStart)->addMonth()->startOfMonth();
                $nextEnd = (clone $nextStart)->endOfMonth();

                $nextQuery = AbsensiKaryawan::join('profile_karyawan', 'absensi_karyawan.id_karyawan', '=', 'profile_karyawan.id')
                    ->select('absensi_karyawan.*','profile_karyawan.nama_lengkap as nama_karyawan')
                    ->whereBetween('tanggal_absensi', [$nextStart->toDateString(), $nextEnd->toDateString()])
                    ->orderBy('tanggal_absensi','desc');

                $nextDesktop = (clone $nextQuery)->paginate(5);
                $nextMobile = (clone $nextQuery)->paginate(2);

                if ($nextDesktop->total() > 0) {
                    // Use next month's data for display and mark that we used next month
                    $fetch_data_absensi_karyawan_desktop = $nextDesktop;
                    $fetch_data_absensi_karyawan_mobile = $nextMobile;
                    $used_next_month = true;
                    $shown_filter_value = $nextStart->format('Y-m');

                    // Append query params for the new pagination (we want pagination to include the shown month)
                    $fetch_data_absensi_karyawan_desktop->appends(['filter_type' => 'month', 'filter_value' => $shown_filter_value]);
                    $fetch_data_absensi_karyawan_mobile->appends(['filter_type' => 'month', 'filter_value' => $shown_filter_value]);
                } else {
                    // No data in the next month either
                    $no_data_next_month = true;
                }
            } catch (\Exception $e) {
                // ignore parsing errors and leave original empty result
            }
        }

        // Weekly fallback: if week filter used but empty, try next ISO week
        if ($filter_type === 'week' && $filter_value && $fetch_data_absensi_karyawan_desktop->total() == 0) {
            try {
                if (preg_match('/^(\d{4})-W?(\d{1,2})$/', $filter_value, $m)) {
                    $year = (int)$m[1];
                    $week = (int)$m[2];
                    // get start (Monday) of requested ISO week
                    $monday = Carbon::now()->setISODate($year, $week)->startOfWeek();
                    $nextMonday = (clone $monday)->addWeek()->startOfWeek();
                    $nextSunday = (clone $nextMonday)->endOfWeek();

                    $nextQuery = AbsensiKaryawan::join('profile_karyawan', 'absensi_karyawan.id_karyawan', '=', 'profile_karyawan.id')
                        ->select('absensi_karyawan.*','profile_karyawan.nama_lengkap as nama_karyawan')
                        ->whereBetween('tanggal_absensi', [$nextMonday->toDateString(), $nextSunday->toDateString()])
                        ->orderBy('tanggal_absensi','desc');

                    $nextDesktop = (clone $nextQuery)->paginate(5);
                    $nextMobile = (clone $nextQuery)->paginate(2);

                    if ($nextDesktop->total() > 0) {
                        $fetch_data_absensi_karyawan_desktop = $nextDesktop;
                        $fetch_data_absensi_karyawan_mobile = $nextMobile;
                        $used_next_week = true;
                        // Format shown filter like 'YYYY-Www'
                        $shown_filter_value_week = $nextMonday->format('o') . '-W' . $nextMonday->format('W');

                        $fetch_data_absensi_karyawan_desktop->appends(['filter_type' => 'week', 'filter_value' => $shown_filter_value_week]);
                        $fetch_data_absensi_karyawan_mobile->appends(['filter_type' => 'week', 'filter_value' => $shown_filter_value_week]);
                    } else {
                        $no_data_next_week = true;
                    }
                }
            } catch (\Exception $e) {
                // ignore parsing errors
            }
        }

        return view('admin.histori_absensi_karyawan',compact('fetch_data_absensi_karyawan_desktop','fetch_data_absensi_karyawan_mobile','used_next_month','requested_filter_value','shown_filter_value','no_data_next_month'));
    }

    public function historyAbsensiByKaryawan(){
        //ambil semua data histori absensi untuk karyawan tertentu
        $fetch_data_mobile =
        AbsensiKaryawan::join('profile_karyawan', 'absensi_karyawan.id_karyawan', '=', 'profile_karyawan.id')
                        ->select('absensi_karyawan.*','profile_karyawan.nama_lengkap')
                        ->paginate(2);

        $fetch_data_desktop =
        AbsensiKaryawan::join('profile_karyawan', 'absensi_karyawan.id_karyawan', '=', 'profile_karyawan.id')
                        ->select('absensi_karyawan.*','profile_karyawan.nama_lengkap')
                        ->paginate(5);
        return view('karyawan.histori_absensi',compact('fetch_data_desktop','fetch_data_mobile'));
    }

    public function historyAbsensi(){
        //ambil histori absensi untuk karyawan yang sedang login (menggunakan session)
        $userId = session('user_id');

        $fetch_data_mobile = AbsensiKaryawan::join('profile_karyawan', 'absensi_karyawan.id_karyawan', '=', 'profile_karyawan.id')
            ->where('absensi_karyawan.id_karyawan', $userId)
            ->select('absensi_karyawan.*','profile_karyawan.nama_lengkap')
            ->paginate(2);

        $fetch_data_desktop = AbsensiKaryawan::join('profile_karyawan', 'absensi_karyawan.id_karyawan', '=', 'profile_karyawan.id')
            ->where('absensi_karyawan.id_karyawan', $userId)
            ->select('absensi_karyawan.*','profile_karyawan.nama_lengkap')
            ->paginate(5);
        
        // Fetch user data from session user_id
        $user = Karyawan::find($userId);

        // Fetch nama karyawan from user data
        $nama_karyawan = $user ? $user->nama_lengkap : (session('user_name') ?? 'Karyawan');

        // Check if today's record has jam_masuk to show clock out button
        $date_only = Carbon::now()->toDateString();
        $today_absensi = AbsensiKaryawan::where('id_karyawan', $userId)->where('tanggal_absensi', $date_only)->first();
        $show_check_out = $today_absensi && $today_absensi->jam_masuk && !$today_absensi->jam_keluar;

        return view('karyawan.histori_absensi',compact('fetch_data_desktop','fetch_data_mobile','show_check_out', 'nama_karyawan'));
    }
    
    public function absensiMasukKamera(){
        return view('karyawan.absensiKameraMasuk');
    }
    public function absensiKeluarKamera(){
        return view('karyawan.absensiKameraKeluar');
    }

    public function rekamMasuk(Request $request){
        //memanggil model AbsensiKaryawan,Karyawan dan User
        $absensi = new AbsensiKaryawan();
        $karyawan = new Karyawan();
        $user = new User();

    // inisiasi jam masuk/keluar kerja tetap: 08:00 dan 17:00 (tanggal hari ini)
    $jam_masuk_kerja = Carbon::today()->setTime(8, 0, 0);
    $jam_keluar_kerja = Carbon::today()->setTime(17, 0, 0);

        //mengambil format tanggal
        $date_only = Carbon::now()->toDateString();
        //mengambil format jam
        $hour_only = Carbon::now()->toDateTimeString();

        //ambil data karyawan (profile) berdasarkan session user id
        $profile = Karyawan::find(session('user_id'));
        // fallback display name if profile missing
        $displayName = $profile && !empty($profile->nama_lengkap) ? $profile->nama_lengkap : (session('name') ?? session('user_name') ?? 'Karyawan');

        // Face verification
        $userId = session('user_id');
        $karyawan = Karyawan::find($userId);
        if (!$karyawan || !$karyawan->imageFileLocation) {
            return redirect()->route('karyawan/histori_absensi')->with('message', 'Face reference not found.');
        }
        // Implement face descriptor comparison here
        // Compare $request->face_descriptor with reference from database
        // Use Euclidean distance: sqrt(sum((a[i] - b[i])^2))
        $distance = 0.3; // Threshold for face match (adjust as needed)
        $match = $distance < 0.4; // Lower distance = better match

        if (!$match) {
            return redirect()->route('karyawan/histori_absensi')->with('message', 'Face verification failed.');
        }

        // Handle photo upload (base64 from camera capture)
        $foto_masuk_path = null;
        if ($request->has('photo') && !empty($request->photo)) {
            $photoData = $request->photo;
            if (preg_match('/^data:image\/(\w+);base64,/', $photoData, $matches)) {
                $extension = $matches[1];
                $photoData = substr($photoData, strpos($photoData, ',') + 1);
                $photoData = base64_decode($photoData);

                $filename = 'absensi_masuk_' . session('user_id') . '_' . time() . '.' . $extension;
                $path = 'absensi_photos/' . $filename;
                \Storage::disk('public')->put($path, $photoData);
                $foto_masuk_path = $path;
            }
        }

        //menentukan status absensi
        $koordinat = $request->input('koordinat', '');
        if (Carbon::now()->lessThanOrEqualTo($jam_masuk_kerja)) {
            $status_absensi = 'Hadir Tepat Waktu';
            $absensi::Create([
                'id_karyawan' => session('user_id'),
                'tanggal_absensi' => $date_only,
                'jam_masuk' => $hour_only,
                'foto_masuk' => $foto_masuk_path,
                'status_absensi' => $status_absensi,
                'koordinat' => $koordinat,
            ]);
        } elseif (Carbon::now()->greaterThan($jam_masuk_kerja) && Carbon::now()->lessThanOrEqualTo($jam_keluar_kerja)) {
            $status_absensi = 'Hadir Terlambat';
            $absensi::Create([
                'id_karyawan' => session('user_id'),
                'tanggal_absensi' => $date_only,
                'jam_masuk' => $hour_only,
                'foto_masuk' => $foto_masuk_path,
                'status_absensi' => $status_absensi,
                'koordinat' => $koordinat,
            ]);
          } else {
              return redirect()->route('karyawan/histori_absensi')->with('message', 'Dear ' . $displayName . ' , jam kerjanya sudah habis.');
          }

          return redirect()->route('karyawan/histori_absensi')->with('message', 'Absensi ' . $displayName . ' berhasil terekam.');
    }
    public function rekamKeluar(Request $request){
        $userId = session('user_id');
        $date_only = Carbon::now()->toDateString();
        $hour_only = Carbon::now()->toDateTimeString();

        // Find today's attendance record
        $absensi = AbsensiKaryawan::where('id_karyawan', $userId)
            ->where('tanggal_absensi', $date_only)
            ->first();

        if (!$absensi) {
            return redirect()->route('karyawan/histori_absensi')->with('message', 'No clock in record found for today.');
        }

        if ($absensi->jam_keluar) {
            return redirect()->route('karyawan/histori_absensi')->with('message', 'Already clocked out today.');
        }

        // Handle photo upload for clock out (base64 from camera capture)
        $foto_keluar_path = null;
        if ($request->has('photo') && !empty($request->photo)) {
            $photoData = $request->photo;
            if (preg_match('/^data:image\/(\w+);base64,/', $photoData, $matches)) {
                $extension = $matches[1];
                $photoData = substr($photoData, strpos($photoData, ',') + 1);
                $photoData = base64_decode($photoData);

                $filename = 'absensi_keluar_' . session('user_id') . '_' . time() . '.' . $extension;
                $path = 'absensi_photos/' . $filename;
                \Storage::disk('public')->put($path, $photoData);
                $foto_keluar_path = $path;
            }
        }

        // Update with clock out time
        $koordinat = $request->input('koordinat', '');
        $absensi->update([
            'jam_keluar' => $hour_only,
            'foto_keluar' => $foto_keluar_path,
            'koordinat' => $koordinat,
        ]);

        $profile = Karyawan::find($userId);
        $displayName = $profile && !empty($profile->nama_lengkap) ? $profile->nama_lengkap : (session('name') ?? session('user_name') ?? 'Karyawan');

        return redirect()->route('karyawan/histori_absensi')->with('message', 'Check-out berhasil untuk ' . $displayName);
    }

    public function exportToExcel(){
        return Excel::download(new AbsensiKaryawanExport,'absensi_karyawan_ingoo_'.Carbon::now().'.xlsx');
    }

    public function verifyFace(Request $request){
        $userId = session('user_id');
        $karyawan = Karyawan::find($userId);
        if (!$karyawan || !$karyawan->imageFileLocation) {
            return response()->json(['success' => false, 'match' => false]);
        }
        // Implement face descriptor comparison here
        // Compare $request->face_descriptor with reference from database
        // Use Euclidean distance: sqrt(sum((a[i] - b[i])^2))
        $distance = 0.3; // Threshold for face match (adjust as needed)
        $match = $distance < 0.3; // Lower distance = better match
        return response()->json(['success' => true, 'match' => $match]);
    }

    /**
     * Fetch sorted absensi data for AJAX requests (no page refresh)
     * Query params: sort_by (tanggal_absensi, jam_masuk, jam_keluar, status_absensi), sort_order (asc, desc)
     */
    public function getAbsensiAjax(Request $request){
        $userId = session('user_id');
        $sortBy = $request->get('sort_by', 'tanggal_absensi');
        $sortOrder = $request->get('sort_order', 'desc');
        $perPage = $request->get('per_page', 5);

        // Validate sort parameters to prevent SQL injection
        $allowedSortBy = ['tanggal_absensi', 'jam_masuk', 'jam_keluar', 'status_absensi'];
        $allowedOrder = ['asc', 'desc'];
        if (!in_array($sortBy, $allowedSortBy)) $sortBy = 'tanggal_absensi';
        if (!in_array($sortOrder, $allowedOrder)) $sortOrder = 'desc';

        // Query and sort by raw database column (before accessor formatting)
        $data = AbsensiKaryawan::join('profile_karyawan', 'absensi_karyawan.id_karyawan', '=', 'profile_karyawan.id')
            ->where('absensi_karyawan.id_karyawan', $userId)
            ->select('absensi_karyawan.*', 'profile_karyawan.nama_lengkap')
            ->orderByRaw("absensi_karyawan.$sortBy $sortOrder")  // Sort by raw DB column (bypasses accessor)
            ->paginate($perPage);

        // Format data for JSON response (now uses accessor formatting for display)
        $rows = $data->items();
        $formattedRows = [];
        foreach ($rows as $index => $row) {
            $formattedRows[] = [
                'index' => $index + 1,
                'tanggal_absensi' => $row->tanggal_absensi,  // Uses getTanggalAbsensiAttribute accessor
                'jam_masuk' => $row->jam_masuk ?? 'N/A',     // Uses getJamMasukAttribute accessor
                'jam_keluar' => $row->jam_keluar ?? 'N/A',   // Uses getJamKeluarAttribute accessor
                'status_absensi' => $row->status_absensi,
                'koordinat' => $row->koordinat ?? 'N/A'
            ];
        }

        return response()->json([
            'success' => true,
            'data' => $formattedRows,
            'pagination' => [
                'current_page' => $data->currentPage(),
                'total_pages' => $data->lastPage(),
                'per_page' => $data->perPage(),
                'total' => $data->total()
            ]
        ]);
    }

    /**
     * Fetch sorted absensi data for ADMIN AJAX requests (all karyawan, no page refresh)
     * Query params: sort_by (tanggal_absensi, jam_masuk, jam_keluar, status_absensi), sort_order (asc, desc)
     */
    public function getAbsensiAdminAjax(Request $request){
        $sortBy = $request->get('sort_by', 'tanggal_absensi');
        $sortOrder = $request->get('sort_order', 'desc');
        $perPage = $request->get('per_page', 5);

        // Validate sort parameters to prevent SQL injection
        $allowedSortBy = ['tanggal_absensi', 'jam_masuk', 'jam_keluar', 'status_absensi'];
        $allowedOrder = ['asc', 'desc'];
        if (!in_array($sortBy, $allowedSortBy)) $sortBy = 'tanggal_absensi';
        if (!in_array($sortOrder, $allowedOrder)) $sortOrder = 'desc';

        // Query all absensi (for admin) and sort by raw database column
        $data = AbsensiKaryawan::join('profile_karyawan', 'absensi_karyawan.id_karyawan', '=', 'profile_karyawan.id')
            ->select('absensi_karyawan.*', 'profile_karyawan.nama_lengkap as nama_karyawan')
            ->orderByRaw("absensi_karyawan.$sortBy $sortOrder")
            ->paginate($perPage);

        // Format data for JSON response
        $rows = $data->items();
        $formattedRows = [];
        foreach ($rows as $index => $row) {
            $formattedRows[] = [
                'index' => $index + 1,
                'nama_karyawan' => $row->nama_karyawan ?? 'N/A',
                'tanggal_absensi' => $row->tanggal_absensi,
                'jam_masuk' => $row->jam_masuk ?? 'N/A',
                'jam_keluar' => $row->jam_keluar ?? 'N/A',
                'status_absensi' => $row->status_absensi,
                'koordinat' => $row->koordinat ?? 'N/A',
                'foto_masuk' => $row->foto_masuk ? '<img src="' . asset('storage/' . $row->foto_masuk) . '" style="max-width:50px; max-height:50px;">' : 'Tidak ada',
                'foto_keluar' => $row->foto_keluar ? '<img src="' . asset('storage/' . $row->foto_keluar) . '" style="max-width:50px; max-height:50px;">' : 'Tidak ada'
            ];
        }

        return response()->json([
            'success' => true,
            'data' => $formattedRows,
            'pagination' => [
                'current_page' => $data->currentPage(),
                'total_pages' => $data->lastPage(),
                'per_page' => $data->perPage(),
                'total' => $data->total()
            ]
        ]);
    }
}
