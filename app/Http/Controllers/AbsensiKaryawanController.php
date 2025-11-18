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
    
    public function historyAbsensiMaster(){
        //ambil semua data histori absensi untuk semua karyawan
        $fetch_data_absensi_karyawan_desktop = AbsensiKaryawan::join('profile_karyawan', 'absensi_karyawan.id_karyawan', '=', 'profile_karyawan.id')
                                                ->select('absensi_karyawan.*','profile_karyawan.nama_lengkap as nama_karyawan')
                                                ->paginate(5);
        $fetch_data_absensi_karyawan_mobile = AbsensiKaryawan::join('profile_karyawan', 'absensi_karyawan.id_karyawan', '=', 'profile_karyawan.id')
                                                ->select('absensi_karyawan.*','profile_karyawan.nama_lengkap as nama_karyawan')
                                                ->paginate(2);
        return view('admin.histori_absensi_karyawan',compact('fetch_data_absensi_karyawan_desktop','fetch_data_absensi_karyawan_mobile'));
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

        //inisiasi jam masuk kerja
        $jam_masuk_kerja = Carbon::now()->setHour(8,0,0);
        $jam_keluar_kerja = Carbon::now()->setHour(17,0,0);

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
        if (Carbon::now()->lessThanOrEqualTo($jam_masuk_kerja)) {
            $status_absensi = 'Hadir Tepat Waktu';
            $absensi::Create([
                'id_karyawan' => session('user_id'),
                'tanggal_absensi' => $date_only,
                'jam_masuk' => $hour_only,
                'foto_masuk' => $foto_masuk_path,
                'status_absensi' => $status_absensi,
                'koordinat' => '',
            ]);
        } elseif (Carbon::now()->greaterThan($jam_masuk_kerja) && Carbon::now()->lessThanOrEqualTo($jam_keluar_kerja)) {
            $status_absensi = 'Hadir Terlambat';
            $absensi::Create([
                'id_karyawan' => session('user_id'),
                'tanggal_absensi' => $date_only,
                'jam_masuk' => $hour_only,
                'foto_masuk' => $foto_masuk_path,
                'status_absensi' => $status_absensi,
                'koordinat' => '',
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
        $absensi->update([
            'jam_keluar' => $hour_only,
            'foto_keluar' => $foto_keluar_path,
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
}
