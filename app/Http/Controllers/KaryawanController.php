<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Models\Karyawan;
use App\Models\RegisterUser;

class KaryawanController extends Controller
{
    public function index(){
        //get all data karyawan
        $fetch_karyawan_mobile = Karyawan::paginate(1);
        $fetch_karyawan_desktop = Karyawan::paginate(2);
        $karyawans = Karyawan::all();
        //rekam dengan json encode
        $karyawansJson = json_encode($karyawans);
        return view('admin.user_management', compact('karyawans','fetch_karyawan_mobile','fetch_karyawan_desktop', 'karyawansJson'));

    }
    public function prosesTambahKaryawan(Request $request){
        //validasi data karyawan
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'NIK' => 'required|string|max:50|unique:profile_karyawan,NIK',
            'bagian' => 'required|string|max:100',
            'jabatan' => 'required|string|max:100',
            'tanggal_masuk_kerja' => 'required|date',
            'nomor_handphone' => 'required|string|max:20',
            'imageFileLocation' => 'nullable|image|mimes:jpg,png|max:3072',
        ]);

        //panggil model Karyawan dan Model User
        $karyawan = new Karyawan();

        //request get data dari form tambah karyawan
        if ($request->hasFile('imageFileLocation')) {
            $path = $request->file('imageFileLocation')->store('karyawan_images', 'public');
            Log::info('Image stored at: ' . $path);
        }
        
        $karyawan::Create([
            'nama_lengkap' => $request->nama_lengkap,
            'tanggal_lahir' => $request->tanggal_lahir,
            'NIK' => $request->NIK,
            'bagian' => $request->bagian,
            'jabatan' => $request->jabatan,
            'tanggal_masuk_kerja' => $request->tanggal_masuk_kerja,
            'nomor_handphone' => $request->nomor_handphone,
            'imageFileLocation' => $request->hasFile('imageFileLocation') ? $path : null,
        ]);

        //membuat username dan password otomatis dari nama_lengkap
        $username = $this->generateUsername($request->nama_lengkap);
        $password = 'ingoo123'; // Password default
        //simpan data user baru di tabel users
        $user = new RegisterUser();
        $user::Create([
            'name' => $username,
            'email' => $username . '@ingoo.test',
            'password' => bcrypt($password),
        ]);
        return redirect()->route('admin.karyawan')->with('message', 'Data Karyawan berhasil ditambahkan dengan username :'.$username);
    }
    private function generateUsername($namaLengkap)
    {
        $search_lambang_atau_kata=array(' ','.','Muhamad','muhamad','Muhammad','muhammad');
        // Hapus spasi dan ubah ke huruf kecil
        $username = strtolower(str_replace($search_lambang_atau_kata,'',$namaLengkap));
        // Cek apakah username sudah ada di database
        $count = RegisterUser::where('name', 'LIKE', "{$username}%")->count();
        // Jika sudah ada, tambahkan angka di belakangnya
        if ($count > 0) {
            $username .= $count + 1;
        }
        return $username;
    }
    public function hapusKaryawan(Request $request){
        //ambil data karyawan dari select option
        $karyawan = Karyawan::find($request->select_karyawan_hapus);
        if ($karyawan) {
            $karyawan->delete();
            return redirect()->route('admin.karyawan')->with('message', 'Data Karyawan Berhasil Dihapus.');
        } else {
            return redirect()->route('admin.karyawan')->with('error', 'Data Karyawan Tidak Ditemukan.');
        }
    }
    public function prosesUpdateKaryawan(Request $request){
        //cari data karyawan berdasarkan id
        $karyawan = Karyawan::find($request->id);

        //validasi foto jpg/png dan maksimal file 3MB
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'NIK' => 'required|string|max:50',
            'bagian' => 'required|string|max:100',
            'jabatan' => 'required|string|max:100',
            'tanggal_masuk_kerja' => 'required|date',
            'nomor_handphone' => 'required|string|max:20',
            'imageFileLocation' => 'nullable|image|mimes:jpg,png|max:3072',
        ]);
        //update foto dengan string lokasi file jika ada file yang diupload
        if ($request->hasFile('imageFileLocation')) {
            // delete old image from public disk if it exists
            if ($karyawan->imageFileLocation && Storage::disk('public')->exists($karyawan->imageFileLocation)) {
                Storage::disk('public')->delete($karyawan->imageFileLocation);
            }
            $karyawan->imageFileLocation = $request->file('imageFileLocation')->store('karyawan_images', 'public');
        }

        //update data karyawan dan foto jika ada
        $karyawan->update([
            'nama_lengkap' => $request->nama_lengkap,
            'tanggal_lahir' => $request->tanggal_lahir,
            'NIK' => $request->NIK,
            'bagian' => $request->bagian,
            'jabatan' => $request->jabatan,
            'tanggal_masuk_kerja' => $request->tanggal_masuk_kerja,
            'nomor_handphone' => $request->nomor_handphone,
            'imageFileLocation' => $karyawan->imageFileLocation,
        ]);
        return redirect()->route('admin.karyawan')->with('message', 'Data Karyawan Berhasil Diupdate.');
    }
}
