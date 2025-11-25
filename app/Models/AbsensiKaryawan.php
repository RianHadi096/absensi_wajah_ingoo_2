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
        'status_absensi',
        'keterangan',
        'foto_sakit',
        'foto_izin',
        'jam_masuk',
        'jam_keluar',
        'koordinat',
        'foto_masuk',
        'foto_keluar',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan', 'id');
    }

    protected $casts = [
        'tanggal_absensi' => 'datetime',
        'jam_masuk' => 'datetime',
        'jam_keluar' => 'datetime',
    ];

    public function getTanggalAbsensiAttribute($value = null)
    {
        $val = $value ?? ($this->attributes['tanggal_absensi'] ?? null);
        if (empty($val)) {
            return null;
        }
        return Carbon::parse($val)->setTimezone('Asia/Jakarta')->format('d-m-Y');
    }
    public function getJamMasukAttribute($value = null)
    {
        $val = $value ?? ($this->attributes['jam_masuk'] ?? null);
        if (empty($val)) {
            return null;
        }
        return Carbon::parse($val)->setTimezone('Asia/Jakarta')->format('H:i:s');
    }
    public function getJamKeluarAttribute($value = null){
        $val = $value ?? ($this->attributes['jam_keluar'] ?? null);
        if (empty($val)){
            return null;
        }
        return Carbon::parse($val)->setTimezone('Asia/Jakarta')->format('H:i:s');
    }
    
}
