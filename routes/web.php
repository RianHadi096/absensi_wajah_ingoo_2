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

Route::get('admin/dashboard', function(){
    return view('dashboard_admin');
})->name('admin/dashboard');

//logout
Route::get('karyawan/logout',[LoginController::class,'logout'])->name('karyawan/logout');
Route::get('admin/logout',[LogoutController::class,'admin_logout'])->name('admin/logout');

//absensi kamera
Route::get('karyawan/absensi_kamera', [AbsensiKaryawanController::class, 'absensiKamera'])->middleware('auth')->name('karyawan/absensi_kamera');

//Route::post('absensiKamera/upload', [AbsensiKaryawanController::class, 'upload'])->middleware('auth')->name('absensiKamera.upload');
Route::post('karyawan/absensi_kamera/rekam', [AbsensiKaryawanController::class, 'testManual'])->middleware('auth')->name('karyawan/absensi_kamera/rekam');
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
Route::get('karyawan/histori_absensi', [AbsensiKaryawanController::class, 'historyAbsensi'])->middleware('auth')->name('karyawan/histori_absensi');

//export absensi ke excel
Route::get('admin/export',[AbsensiKaryawanController::class,'exportToExcel'])->name('admin/export');