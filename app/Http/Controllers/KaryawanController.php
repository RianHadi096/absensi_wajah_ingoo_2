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

class KaryawanController extends Controller
{
    public function dashboard(){
        //cek apakah karyawan sudah absen masuk dan absen keluar hari ini
        $userId = session('user_id');
        $today_absensi = \App\Models\AbsensiKaryawan::where('id_karyawan', $userId)
            ->where('tanggal_absensi', date('Y-m-d'))
            ->first();
        $sudah_absen_masuk = $today_absensi && $today_absensi->jam_masuk ? true : false;
        $sudah_absen_keluar = $today_absensi && $today_absensi->jam_keluar ? true : false;

        return view('dashboard_karyawan', compact('sudah_absen_masuk','sudah_absen_keluar'));
    }

    public function index(){
        //get all data karyawan
        $fetch_karyawan_mobile = Karyawan::paginate(2);
        $fetch_karyawan_desktop = Karyawan::paginate(2);
        $karyawans = Karyawan::all();
        //rekam dengan json encode
        $karyawansJson = json_encode($karyawans);
        return view('admin.user_management', compact('karyawans','fetch_karyawan_mobile','fetch_karyawan_desktop', 'karyawansJson'));

    }
    
    public function profileKaryawan($id){
        //join tabel karyawan dengan tabel users berdasarkan id_karyawan
        $karyawan = Karyawan::find($id);
        $user = RegisterUser::where('id', $id)->first();
        //tanggal lahir format Indonesia dan tidak beserta jam
        $tanggal_lahir = date('d-m-Y', strtotime($karyawan->tanggal_lahir));
        $tanggal_masuk_kerja = date('d-m-Y', strtotime($karyawan->tanggal_masuk_kerja));
        $username = $user ? $user->name : null;
        $email = $user ? $user->email : null;
        return view('karyawan.profile_karyawan', compact('karyawan','username','email','tanggal_lahir','tanggal_masuk_kerja'));
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
            'jam_kerja' => 'nullable|string|max:20',
            'batas_jam_kerja' => 'nullable|string|max:20',
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
            'jam_kerja' => $request->jam_kerja,
            'batas_jam_kerja' => $request->batas_jam_kerja,
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
            'jam_kerja' => 'nullable|string|max:20',
            'batas_jam_kerja' => 'nullable|string|max:20',
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
            'jam_kerja' => $request->jam_kerja,
            'batas_jam_kerja' => $request->batas_jam_kerja,
        ]);
        return redirect()->route('admin.karyawan')->with('message', 'Data Karyawan Berhasil Diupdate.');
    }
    //ganti password
    public function changePassword(Request $request){
        //validasi password
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        //cek password lama
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
        }

        //update password baru
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('message', 'Password berhasil diubah.');
    }

}
