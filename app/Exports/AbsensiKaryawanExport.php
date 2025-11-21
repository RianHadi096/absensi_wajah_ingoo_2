<?php

namespace App\Exports;

use App\Models\AbsensiKaryawan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\Color;
use Illuminate\Support\Facades\DB;

class AbsensiKaryawanExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithEvents
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
                'absensi_karyawan.jam_masuk',
                'absensi_karyawan.jam_keluar',
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
            'Jam Masuk',
            'Jam Keluar',
            'Status Absensi',
            'Koordinat (Link)',
        ];
    }

    /**
     * Transform each row: convert koordinat to Google Maps link
     */
    public function map($row): array
    {
        // Parse koordinat (expected format: "latitude,longitude")
        $koordinat = $row->koordinat;
        $mapsLink = $koordinat; // fallback to raw value if parsing fails

        if ($koordinat && strpos($koordinat, ',') !== false) {
            // Assume format: "latitude,longitude"
            $mapsLink = "https://www.google.com/maps?q=" . urlencode($koordinat);
        }

        return [
            $row->nama_karyawan,
            $row->tanggal_absensi,
            $row->jam_masuk,
            $row->jam_keluar,
            $row->status_absensi,
            $mapsLink, // This will be the hyperlink
        ];
    }

    /**
     * Style the spreadsheet
     */
    public function styles(Worksheet $sheet)
    {
        // Make header row bold
        $sheet->getStyle('A1:F1')->getFont()->setBold(true);

        // Auto-fit column widths
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);

        return $sheet;
    }

    /**
     * Add hyperlinks to the koordinat column after sheet is created
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $lastRow = $sheet->getHighestRow();

                // Add hyperlinks to column F (koordinat) starting from row 2
                for ($row = 2; $row <= $lastRow; $row++) {
                    $cell = $sheet->getCell('F' . $row);
                    $url = $cell->getValue();

                    // Only set hyperlink if URL is valid
                    if ($url && (strpos($url, 'http://') === 0 || strpos($url, 'https://') === 0)) {
                        $cell->setHyperlink(new \PhpOffice\PhpSpreadsheet\Cell\Hyperlink($url, $url));
                        // Style as blue underlined
                        $cell->getStyle()->getFont()->setUnderline(Font::UNDERLINE_SINGLE)->setColor(new Color('0563C1'));
                    }
                }
            }
        ];
    }
}
