<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class AbsensiKaryawan extends Model
{
    protected $table = 'absensi_karyawan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_karyawan',
        'tanggal_absensi',
        'waktu_absensi',
        'status_absensi',
        'koordinat',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan', 'id');
    }

    protected $casts = [
        'tanggal_absensi' => 'datetime',
        'waktu_absensi' => 'datetime',
    ];

    public function getWaktuAbsensiAttribute($value)
    {
        return Carbon::parse($value)->setTimezone('Asia/Jakarta')->format('H:i:s');
    }

    public function getTanggalAbsensiAttribute($value)
    {
        return Carbon::parse($value)->setTimezone('Asia/Jakarta')->format('d-m-Y');
    }
    
}
