<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassPackageSeeder extends Seeder
{
    public function run()
    {
        $packages = [
            // ----------------------------------------------------
            // KATEGORI 1: HBA (Horseback Archery)
            // ----------------------------------------------------
            [
                'title'         => '🏹 Paket HBA',
                'category'      => 'HBA',
                'description'   => 'Program intensif panahan berkuda untuk hasil maksimal.',
                'price_main'    => 'Rp 2.000.000',
                'price_detail'  => '8 Sesi @ 45 Menit',
                'price_weekday' => null,
                'price_weekend' => null,
                'is_popular'    => true,
            ],
            [
                'title'         => '🐎 Beginner Riding',
                'category'      => 'HBA',
                'description'   => 'Dasar-dasar berkuda bagi pemula yang ingin mulai belajar.',
                'price_main'    => null,
                'price_detail'  => null,
                'price_weekday' => 'Rp 300.000',
                'price_weekend' => 'Rp 350.000',
                'is_popular'    => false,
            ],
            [
                'title'         => '🏹 Shoot on Horse',
                'category'      => 'HBA',
                'description'   => 'Latihan khusus teknik memanah di atas punggung kuda.',
                'price_main'    => null,
                'price_detail'  => null,
                'price_weekday' => 'Rp 300.000',
                'price_weekend' => 'Rp 350.000',
                'is_popular'    => false,
            ],

            // ----------------------------------------------------
            // KATEGORI 2: EQUESTRIAN
            // ----------------------------------------------------
            [
                'title'         => '🏜️ Endurance',
                'category'      => 'Equestrian',
                'description'   => 'Latihan ketahanan fisik dan stamina kuda jarak jauh.',
                'price_main'    => 'Rp 500.000',
                'price_detail'  => 'Per Sesi',
                'price_weekday' => null,
                'price_weekend' => null,
                'is_popular'    => false,
            ],
            [
                'title'         => '🎖️ Equestrian (Dressage)',
                'category'      => 'Equestrian',
                'description'   => 'Seni kemahiran berkuda, harmoni, dan keanggunan.',
                'price_main'    => 'Rp 600.000',
                'price_detail'  => 'Per Sesi',
                'price_weekday' => null,
                'price_weekend' => null,
                'is_popular'    => false,
            ],
        ];

        // Masukkan data ke database
        DB::table('class_packages')->insert($packages);
    }
}