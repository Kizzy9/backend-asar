<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('class_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('package_name'); // Menyimpan nama paket yang dipilih
            $table->string('nama_lengkap');
            $table->integer('umur');
            $table->string('tempat_lahir')->nullable();
            $table->string('nomor_whatsapp');
            $table->text('alamat_domisili')->nullable();
            $table->enum('status', ['pending', 'dihubungi', 'selesai'])->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('class_registrations');
    }
};