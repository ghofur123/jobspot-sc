<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLowongan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lowongan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_perusahaan');
            $table->string('title');
            $table->text('kualifikasi');
            $table->integer('pendidikan_id');
            $table->string('status_kerja');
            $table->integer('tipe_pekerjaan_id');
            $table->string('gaji');
            $table->integer('bidang_pekerjaan_id');
            $table->integer('industri_id');
            $table->string('lokasi_kerja');
            $table->text('deskripsi');
            $table->text('syarat');
            $table->text('benefit');
            $table->integer('users_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lowongan');
    }
}
