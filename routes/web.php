<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AbsensiKaryawanController;
use App\Http\Controllers\KaryawanController;

Route::get('/', [LoginController::class, 'showLoginForm']);

//register
//Route::get('register',[RegisterController::class,'showRegisterForm'])->name('register');
//Route::post('register/proses',[RegisterController::class,'prosesRegister'])->name('prosesRegister');

//login
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');

//Login authenticate
Route::post('login/prosesAuth', [LoginController::class, 'authenticate'])->name('prosesAuthentifikasi');

//dashboard
Route::get('karyawan/dashboard', function () {
    return view('dashboard_karyawan');
})->middleware('auth')->name('karyawan/dashboard');

//dashboard karyawan
Route::get('karyawan/dashboard', [KaryawanController::class, 'dashboard'])->middleware('auth')->name('karyawan/dashboard');

//logout
Route::get('karyawan/logout',[LogoutController::class,'logout'])->name('karyawan/logout');
Route::get('admin/logout',[LogoutController::class,'admin_logout'])->name('admin/logout');

//absensi kamera
Route::get('karyawan/absensi_kamera/check_in', [AbsensiKaryawanController::class, 'absensiMasukKamera'])->middleware('auth')->name('karyawan/absensi_kamera/check_in');
Route::get('karyawan/absensi_kamera/check_out', [AbsensiKaryawanController::class, 'absensiKeluarKamera'])->middleware('auth')->name('karyawan/absensi_kamera/check_out');

//Route::post('absensiKamera/upload', [AbsensiKaryawanController::class, 'upload'])->middleware('auth')->name('absensiKamera.upload');
Route::post('karyawan/absensi_kamera/rekam_check_in', [AbsensiKaryawanController::class, 'rekamMasuk'])->middleware('auth')->name('karyawan/absensi_kamera/rekam_check_in');
Route::post('karyawan/absensi_kamera/rekam_check_out', [AbsensiKaryawanController::class, 'rekamKeluar'])->middleware('auth')->name('karyawan/absensi_kamera/rekam_check_out');

// verify face via POST (expects JSON) - protected by auth so session user is available
Route::post('karyawan/absensi_kamera/verify', [AbsensiKaryawanController::class, 'verifyFace'])->middleware('auth')->name('karyawan/absensi_kamera/verify');


//data karyawan
Route::get('admin/karyawan', [KaryawanController::class, 'index'])->name('admin.karyawan');

//tambah data karyawan
Route::post('admin/tambahkaryawan/proses',[KaryawanController::class,'prosesTambahKaryawan'])->name('prosesTambahKaryawan');

//hapus data karyawan
Route::get('admin/hapuskaryawan', [KaryawanController::class, 'hapusKaryawan'])->name('hapusKaryawan');

//update data karyawan
Route::post('admin/updatekaryawan/proses',[KaryawanController::class,'prosesUpdateKaryawan'])->name('prosesEditKaryawan');

//histori absensi karyawan
Route::get('admin/histori_absensi_karyawan', [AbsensiKaryawanController::class, 'historyAbsensiMaster'])->name('histori_absensi_karyawan');
// AJAX endpoint for sorted absensi data (admin)
Route::get('admin/histori_absensi_karyawan/ajax', [AbsensiKaryawanController::class, 'getAbsensiAdminAjax'])->name('admin.histori_absensi_ajax');
Route::get('karyawan/histori_absensi', [AbsensiKaryawanController::class, 'historyAbsensi'])->middleware('auth')->name('karyawan/histori_absensi');
// AJAX endpoint for sorted absensi data (karyawan)
Route::get('karyawan/histori_absensi/ajax', [AbsensiKaryawanController::class, 'getAbsensiAjax'])->middleware('auth')->name('karyawan/histori_absensi/ajax');

//export absensi ke excel
Route::get('admin/export',[AbsensiKaryawanController::class,'exportToExcel'])->name('admin/export');

//profile karyawan dengan auth id
Route::get('karyawan/profile/{id}', [KaryawanController::class, 'profileKaryawan'])->middleware('auth')->name('karyawan.profile');
Route::post('karyawan/change-password', [KaryawanController::class, 'changePassword'])->middleware('auth')->name('karyawan.changePassword');

//absensi karyawan page
Route::get('karyawan/absensi', [AbsensiKaryawanController::class, 'absensiPage'])->middleware('auth')->name('karyawan/absensi');

//absensi izin dan sakit
Route::get('karyawan/absensi/izin', [AbsensiKaryawanController::class, 'absensiIzin'])->middleware('auth')->name('karyawan/absensi/izin');
Route::get('karyawan/absensi/sakit', [AbsensiKaryawanController::class, 'absensiSakit'])->middleware('auth')->name('karyawan/absensi/sakit');
Route::post('karyawan/absensi/rekam_izin', [AbsensiKaryawanController::class, 'rekamIzin'])->middleware('auth')->name('karyawan/absensi/rekam_izin');
Route::post('karyawan/absensi/rekam_sakit', [AbsensiKaryawanController::class, 'rekamSakit'])->middleware('auth')->name('karyawan/absensi/rekam_sakit');
