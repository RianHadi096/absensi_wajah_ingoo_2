<?php

namespace App\Exports;

use App\Models\AbsensiKaryawan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AbsensiKaryawanExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = AbsensiKaryawan::join('profile_karyawan', 'absensi_karyawan.id_karyawan', '=', 'profile_karyawan.id')
            ->select(
                'profile_karyawan.nama_lengkap as nama_karyawan',
                'absensi_karyawan.tanggal_absensi',
                'absensi_karyawan.waktu_absensi',
                'absensi_karyawan.status_absensi',
                'absensi_karyawan.koordinat'
            )
            ->get();

        return $data;
    }
    public function headings(): array
    {
        return [
            'Nama Karyawan',
            'Tanggal Absensi',
            'Waktu Absensi',
            'Status Absensi',
            'Koordinat',
        ];
    }
}
