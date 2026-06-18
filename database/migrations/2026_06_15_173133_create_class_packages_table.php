<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('class_packages', function (Blueprint $table) {
            $table->id();
            
            // Nama paket (contoh: Paket HBA)
            $table->string('title');
            
            // Kategori (HBA atau Equestrian)
            $table->string('category');
            
            // Deskripsi kelas
            $table->text('description')->nullable();
            
            // Harga utama jika berupa paket/per sesi
            $table->string('price_main')->nullable();
            
            // Detail tambahan (contoh: 8 Sesi @ 45 Menit)
            $table->string('price_detail')->nullable();
            
            // Harga hari kerja
            $table->string('price_weekday')->nullable();
            
            // Harga akhir pekan
            $table->string('price_weekend')->nullable();
            
            // Penanda apakah paket ini paling populer (1 = Ya, 0 = Tidak)
            $table->boolean('is_popular')->default(false);
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('class_packages');
    }
};