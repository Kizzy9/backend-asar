<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = \App\Models\User::updateOrCreate(
            ['email' => 'contoh@abdul.com'],
            [
                'name' => 'Abdul Ksatria',
                'username' => 'abdul123',
                'password' => \Illuminate\Support\Facades\Hash::make('password123'),
                'role' => 'member',
            ]
        );

        // Admin User
        \App\Models\User::updateOrCreate(
            ['email' => 'admin@asarstable.com'],
            [
                'name' => 'Coach Zaky (Admin)',
                'username' => 'admin',
                'password' => \Illuminate\Support\Facades\Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        \App\Models\UserProgress::updateOrCreate(
            ['user_id' => $user->id],
            [
                'current_level' => 'HBA Pemula (Tahap 2)',
                'progress_percent' => 45,
                'skills' => [
                    ['name' => 'Pengenalan & Bonding Kuda', 'status' => 'checked'],
                    ['name' => 'Keseimbangan Dasar (Walk)', 'status' => 'checked'],
                    ['name' => 'Postur Posting Trot', 'status' => 'active'],
                    ['name' => 'Teknik Panahan Bawah', 'status' => 'locked']
                ],
                'coach_name' => 'Coach Zaky',
                'instructor_note' => 'Postur punggung sudah jauh lebih tegak dari minggu lalu. Jangan lupa latihan pernapasan sebelum naik ya agar Bintang (kuda) ikut rileks. Sampai jumpa hari Jumat!',
                'note_date' => now()
            ]
        );
    }
}
