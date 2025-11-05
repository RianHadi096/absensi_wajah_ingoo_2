<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AbsensiKaryawan;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class AbsensiKaryawanController extends Controller
{
    public function historyAbsensiMaster(){
        //ambil semua data histori absensi untuk semua karyawan
        $fetch_data_absensi_karyawan = AbsensiKaryawan::join('profile_karyawan', 'absensi_karyawan.id_karyawan', '=', 'profile_karyawan.id')
                                                ->select('absensi_karyawan.*','profile_karyawan.nama_lengkap as nama_karyawan')
                                                ->paginate(10);
        return view('admin.histori_absensi_karyawan',compact('fetch_data_absensi_karyawan'));
    }
    public function historyAbsensi(){
        //ambil semua data histori absensi untuk karyawan tertentu
        $fetch_data =
        AbsensiKaryawan::join('profile_karyawan', 'absensi_karyawan.id_karyawan', '=', 'profile_karyawan.id')
                        ->select('absensi_karyawan.*','profile_karyawan.nama_lengkap')
                        ->paginate(1);
        return view('karyawan.histori_absensi',compact('fetch_data'));
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

        //menentukan status absensi
        if (Carbon::now()->lessThanOrEqualTo($jam_masuk_kerja)) {
            $status_absensi = 'Hadir Tepat Waktu';
        } elseif (Carbon::now()->greaterThan($jam_masuk_kerja) && Carbon::now()->lessThanOrEqualTo($jam_keluar_kerja)) {
            $status_absensi = 'Hadir Terlambat';
        } else {
            $status_absensi = 'Tidak Hadir';
        }

        $absensi::Create([
            'id_karyawan' => session('user_id'),
            'tanggal_absensi' => $date_only,
            'waktu_absensi' => $hour_only,
            'status_absensi' => $status_absensi,
            'koordinat' => '',
        ]);
        //mengambil nama karyawan berdasarkan id_karyawan dari tabel absensi_karyawan
        $get_nama_karyawan = AbsensiKaryawan::
            join('profile_karyawan', 'absensi_karyawan.id_karyawan', '=', 'profile_karyawan.id')
            ->where('absensi_karyawan.id_karyawan', session('user_id'))
            ->select('profile_karyawan.nama_lengkap')
            ->first();

        return redirect()->route('karyawan/histori_absensi')->with('message', 'Absensi ' . $get_nama_karyawan->nama_lengkap . ' berhasil terekam.');
    }
}
