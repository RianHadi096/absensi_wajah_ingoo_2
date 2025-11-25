<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //tambahkan kolom foto_sakit dan foto_izin pada tabel absensi_karyawans
        Schema::table('absensi_karyawan', function (Blueprint $table) {
            $table->string('keterangan')->nullable()->after('status_absensi');
            $table->string('foto_sakit')->nullable()->after('keterangan');
            $table->string('foto_izin')->nullable()->after('foto_sakit');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //hapus kolom foto_sakit dan foto_izin pada tabel absensi_karyawans
        Schema::table('absensi_karyawan', function (Blueprint $table) {
            $table->dropColumn('keterangan');
            $table->dropColumn('foto_sakit');
            $table->dropColumn('foto_izin');
        });
    }
};
