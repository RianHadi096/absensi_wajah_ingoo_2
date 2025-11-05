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
        Schema::create('profile_karyawan', function (Blueprint $table) {
            //membuat kolom id dengan primary key dan auto increment
            $table->id();
            //membuat kolom users_id dari tabel users
            $table->unsignedBigInteger('users_id');
            //membuat kolom nama
            $table->string('nama_lengkap',100);
            //membuat tanggal lahir
            $table->date('tanggal_lahir');
            //membuat NIK
            $table->string('NIK',16)->unique();
            //membuat bagian
            $table->string('bagian')->nullable();
            //membuat kolom jabatan_karyawan
            $table->string('jabatan')->nullable();
            //membuat kolom tanggal masuk kerja
            $table->date('tanggal_masuk_kerja');
            //membuat kolom nomor handphone
            $table->string('nomor_handphone',16);
            //membuat kolom imageFileLocation di tabel profile_karyawan
            $table->string('imageFileLocation')->nullable();
            //membuat created_at dan updated_at
            $table->timestamps();

            //membuat foreign key users_id dengan onDelete=cascade
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_karyawan');
    }
};
