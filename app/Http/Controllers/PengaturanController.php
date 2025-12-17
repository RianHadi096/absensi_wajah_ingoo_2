<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Karyawan;
use App\Models\RegisterUser;

class PengaturanController extends Controller{
    
    public function settingKaryawan(){
        return view('karyawan.pengaturan_karyawan');
    }
    public function settingAdmin(){
        return view('admin.pengaturan_admin');
    }
    public function updateJamKerja(Request $request){
        $jabatanInput = $request->input('jabatan');
        $jam_kerja = $request->input('jam_kerja');
        $batas_jam_kerja = $request->input('batas_jam_kerja');

        // Validasi input
        $request->validate([
            'jabatan' => 'required|string|in:teknisi,marketing',
            'jam_kerja' => 'required|date_format:H:i',
            'batas_jam_kerja' => 'required|date_format:H:i|after:jam_kerja',
        ]);

        // Mengubah input jabatan menjadi format yang benar (Title Case) untuk database
        $jabatan = ucfirst($jabatanInput);

        // Update jam kerja dan batas jam kerja untuk karyawan dengan jabatan tertentu
        Karyawan::where('jabatan', $jabatan)->update([
            'jam_kerja' => $jam_kerja,
            'batas_jam_kerja' => $batas_jam_kerja,
        ]);

        return redirect()->route('admin.pengaturan')->with('message', 'Jam kerja untuk jabatan ' . $jabatan . ' berhasil diperbarui.');
    }
}
