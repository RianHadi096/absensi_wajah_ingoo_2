<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AbsensiKaryawan;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Exports\AbsensiKaryawanExport;
use Illuminate\Contracts\Session\Session;
use Maatwebsite\Excel\Facades\Excel;

class AbsensiKaryawanController extends Controller
{
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

        return view('karyawan.histori_absensi',compact('fetch_data_desktop','fetch_data_mobile'));
    }
    public function absensiKamera(){
        return view('karyawan.absensiKamera');
    }

    public function testManual(){
        //memanggil model AbsensiKaryawan,Karyawan dan User
        $absensi = new AbsensiKaryawan();
        $karyawan = new Karyawan();
        $user = new User();

        //inisiasi jam masuk kerja
        $jam_masuk_kerja = Carbon::now()->setHour(8,0,0);
        $jam_keluar_kerja = Carbon::now()->setHour(16,0,0);

        //mengambil format tanggal
        $date_only = Carbon::now()->toDateString();
        //mengambil format jam
        $hour_only = Carbon::now()->toDayDateTimeString();

        
        //ambil data karyawan (profile) berdasarkan session user id
        $profile = Karyawan::find(session('user_id'));
        // fallback display name if profile missing
        $displayName = $profile && !empty($profile->nama_lengkap) ? $profile->nama_lengkap : (session('name') ?? session('user_name') ?? 'Karyawan');

        //menentukan status absensi
        if (Carbon::now()->lessThanOrEqualTo($jam_masuk_kerja)) {
            $status_absensi = 'Hadir Tepat Waktu';
            $absensi::Create([
                'id_karyawan' => session('user_id'),
                'tanggal_absensi' => $date_only,
                'waktu_absensi' => $hour_only,
                'status_absensi' => $status_absensi,
                'koordinat' => '',
            ]);
        } elseif (Carbon::now()->greaterThan($jam_masuk_kerja) && Carbon::now()->lessThanOrEqualTo($jam_keluar_kerja)) {
            $status_absensi = 'Hadir Terlambat';
            $absensi::Create([
                'id_karyawan' => session('user_id'),
                'tanggal_absensi' => $date_only,
                'waktu_absensi' => $hour_only,
                'status_absensi' => $status_absensi,
                'koordinat' => '',
            ]);
          } else {
              return redirect()->route('karyawan/histori_absensi')->with('message', 'Dear ' . $displayName . ' , jam kerjanya sudah habis.');
          }

          return redirect()->route('karyawan/histori_absensi')->with('message', 'Absensi ' . $displayName . ' berhasil terekam.');
    }

    public function exportToExcel(){
        return Excel::download(new AbsensiKaryawanExport,'absensi_karyawan_ingoo_'.Carbon::now().'.xlsx');
    }

    public function verifyFace(Request $request)
{
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
