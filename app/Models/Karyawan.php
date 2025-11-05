<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Karyawan extends Model
{
    //menyimpan data karyawan pada tabel profile_karyawan
    protected $table = 'profile_karyawan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_lengkap',
        'tanggal_lahir',
        'NIK',
        'bagian',
        'jabatan',
        'tanggal_masuk_kerja',
        'nomor_handphone',
        'imageFileLocation',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_masuk_kerja' => 'date',
    ];
}
