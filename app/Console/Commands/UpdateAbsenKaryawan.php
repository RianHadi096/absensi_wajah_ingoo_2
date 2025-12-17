<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AbsensiKaryawan;
use App\Models\Karyawan;
use Illuminate\Support\Carbon;

class UpdateAbsenKaryawan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-absensi-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update absensi data for karyawan who did not clock out and mark absent karyawan';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting update absensi process...');

        // Get today's date
        $today = Carbon::now()->toDateString();

        // Step 1: Update absensi records for today that have jam_masuk but no jam_keluar
        $absensiRecords = AbsensiKaryawan::where('tanggal_absensi', $today)
            ->whereNotNull('jam_masuk')
            ->whereNull('jam_keluar')
            ->get();

        $updatedCount = 0;

        foreach ($absensiRecords as $record) {
            // Set jam_keluar to 17:00 if not already set
            $record->update([
                'jam_keluar' => Carbon::createFromTime(17, 0, 0)->toDateTimeString(),
            ]);
            $updatedCount++;
        }

        $this->info("Updated {$updatedCount} absensi records with jam_keluar at 17:00.");

        // Step 2: Mark karyawan who did not attend as absent
        $karyawanIdsWithAbsensi = AbsensiKaryawan::where('tanggal_absensi', $today)
            ->pluck('id_karyawan')
            ->toArray();

        $allKaryawan = Karyawan::pluck('id')->toArray();

        $absentKaryawanIds = array_diff($allKaryawan, $karyawanIdsWithAbsensi);

        $absentCount = 0;

        foreach ($absentKaryawanIds as $karyawanId) {
            AbsensiKaryawan::create([
                'id_karyawan' => $karyawanId,
                'tanggal_absensi' => $today,
                'jam_masuk' => null,
                'jam_keluar' => null,
                'foto_masuk' => null,
                'foto_keluar' => null,
                'status_absensi' => 'Tidak Hadir',
                'koordinat' => '',
            ]);
            $absentCount++;
        }

        $this->info("Marked {$absentCount} karyawan as absent for today.");
        $this->info('Update absensi process completed.');
    }
}
