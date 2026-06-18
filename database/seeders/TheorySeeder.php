<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Theory;

class TheorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Bersihkan data lama jika ada agar tidak double
        Theory::truncate();

        // Materi 1: Posisi Belajar
        Theory::create([
            'title' => '1. Fundamental Posisi Duduk (Basic Seat)',
            'excerpt' => 'Kunci utama dari berkuda adalah keseimbangan tubuh. Pelajari postur tegak, posisi bahu, dan tumit yang benar.',
            'image_url' => 'https://images.unsplash.com/photo-1553284965-83fd3e82fa5a?auto=format&fit=crop&w=600&q=80',
            'content' => '
                <h3>Pedoman Posisi Tubuh yang Benar:</h3>
                <p>Saat berada di atas pelana, tubuh Anda harus membentuk garis lurus imajiner mulai dari telinga, bahu, pinggul, hingga tumit kaki Anda.</p>
                <ul>
                    <li><strong>Pandangan Mata:</strong> Selalu fokus melihat ke depan di antara kedua telinga kuda, hindari melihat ke bawah karena akan merusak keseimbangan.</li>
                    <li><strong>Punggung & Postur:</strong> Duduk tegak namun tetap rileks (jangan kaku), serap pergerakan punggung kuda menggunakan area pinggul Anda.</li>
                    <li><strong>Posisi Kaki:</strong> Bagian terlebar telapak kaki menumpu pada sanggurdi (stirrup), dan pastikan <strong>tumit kaki selalu menekan ke bawah</strong> untuk mengunci posisi Anda di pelana.</li>
                </ul>
            '
        ]);

        // Materi 2: Belajar Kontak
        Theory::create([
            'title' => '2. Membangun Contact & Tali Kekang (Reins Control)',
            'excerpt' => 'Kontak yang lembut melalui tali kekang adalah jembatan komunikasi utama antara tangan rider dan mulut kuda.',
            'image_url' => 'https://images.unsplash.com/photo-1601987077677-5346c0c57d3f?auto=format&fit=crop&w=600&q=80',
            'content' => '
                <h3>Cara Memegang Tali Kekang & Mengatur Kontak (Contact):</h3>
                <p>Tali kekang bukanlah alat untuk berpegangan agar tidak jatuh, melainkan alat kemudi. Kontak yang baik harus terasa konstan, mantap, namun tetap lembut bagi mulut kuda.</p>
                <ul>
                    <li><strong>Cara Memegang:</strong> Tali kekang masuk melalui celah antara jari kelingking dan jari manis, lalu keluar di atas ibu jari yang menjepit dengan kuat.</li>
                    <li><strong>Siku yang Fleksibel:</strong> Pastikan lengan atas dan siku Anda menekuk fleksibel mengikuti irama gerakan maju-mundur kepala kuda (mengikuti ritme walk, trot, atau canter).</li>
                    <li><strong>Prinsip Give & Take:</strong> Jangan menarik tali secara kasar dan terus-menerus. Tarik sedikit untuk memberi aba-aba (take), dan segera kendurkan kembali (give) begitu kuda merespons perintah Anda.</li>
                </ul>
            '
        ]);

        // Materi 3: Larangan
        Theory::create([
            'title' => '3. Larangan Keras saat Berada di Area Berkuda (Don\'ts)',
            'excerpt' => 'Aturan keselamatan krusial yang wajib dipatuhi demi keamanan diri sendiri, orang lain, dan kuda di Asar Stable.',
            'image_url' => 'https://images.unsplash.com/photo-1599256621730-535171e28e50?auto=format&fit=crop&w=600&q=80',
            'content' => '
                <h3>Hal-Hal yang DILARANG KERAS demi Keselamatan Bersama:</h3>
                <p>Kuda adalah hewan mangsa (prey animal) yang memiliki insting waspada tinggi dan mudah terkejut. Melanggar poin di bawah ini dapat berakibat cedera fatal.</p>
                <ol>
                    <li><strong>Dilarang Berdiri atau Berjalan Tepat di Belakang Kuda:</strong> Ini adalah area titik buta (blind spot) utama kuda. Jika kuda terkejut dari belakang, refleks alaminya adalah menendang dengan sangat keras.</li>
                    <li><strong>Jangan Membuat Gerakan Tiba-tiba atau Suara Berisik:</strong> Hindari berteriak, berlari, atau membuka payung/benda mencolok secara mendadak di dekat area latihan.</li>
                    <li><strong>Jangan Melilitkan Tali Kekang ke Tangan atau Jari:</strong> Jika kuda tiba-tiba panik dan menarik kekangannya, tangan Anda bisa terseret dan mengalami patah tulang.</li>
                    <li><strong>Dilarang Mengabaikan Alat Pelindung Diri (APD):</strong> Jangan pernah menaiki kuda tanpa menggunakan Helm standar keselamatan berkuda dan sepatu khusus (boots).</li>
                </ol>
            '
        ]);
    }
}