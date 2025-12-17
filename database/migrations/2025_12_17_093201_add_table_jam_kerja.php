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
        //tambah kolom jam kerja dan batas jam kerja
        Schema::table('profile_karyawan', function (Blueprint $table) {
            $table->time('jam_kerja');
            $table->time('batas_jam_kerja');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //hapus kolom jam kerja dan batas jam kerja
        Schema::table('profile_karyawan', function (Blueprint $table) {
            $table->dropColumn('jam_kerja');
            $table->dropColumn('batas_jam_kerja');
        });
        
    }
};
