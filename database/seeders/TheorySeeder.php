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
            'image_url' => '/images/theories/basic_seat.png',
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
            'image_url' => '/images/theories/reins.png',
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
            'image_url' => '/images/theories/donts.png',
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

        // Materi 4: Memanah (HBA)
        Theory::create([
            'title' => '4. Fundamental Horseback Archery (HBA)',
            'excerpt' => 'Teknik dasar memanah di atas kuda. Fokus pada melepas tali kekang (blind riding) dan nocking anak panah dengan cepat.',
            'image_url' => '/images/theories/archery.png',
            'content' => '
                <h3>Teknik Dasar Memanah Berkuda (Horseback Archery):</h3>
                <p>Memanah di atas kuda membutuhkan keseimbangan tingkat tinggi karena Anda harus melepaskan kendali tangan dari tali kekang. Ini sering disebut sebagai <strong>Blind Riding</strong> atau kemudi menggunakan postur tubuh.</p>
                <ul>
                    <li><strong>Kemudi Tanpa Tangan (Seat & Leg Aids):</strong> Anda harus sepenuhnya mengandalkan tekanan kaki dan pergeseran berat badan (pinggul) untuk mengarahkan atau menahan laju kuda.</li>
                    <li><strong>Posisi Memanah (The Archer\'s Form):</strong> Berdiri sedikit dari pelana saat kuda berlari untuk meredam guncangan (Half-Seat position), putar pinggang menghadap target tanpa mengubah arah pandangan kuda.</li>
                    <li><strong>Nocking Cepat (Fast Nocking):</strong> Dalam HBA, kecepatan memasang anak panah ke tali busur sangat krusial. Gunakan teknik quiver samping atau memegang beberapa panah di tangan busur.</li>
                </ul>
            '
        ]);

        // Materi 5: Jumping
        Theory::create([
            'title' => '5. Persiapan Dasar Show Jumping (Lompat Rintangan)',
            'excerpt' => 'Mengenal teknik Two-Point Position dan mengatur langkah kuda (strides) sebelum melompat.',
            'image_url' => '/images/theories/jumping.png',
            'content' => '
                <h3>Dasar-Dasar untuk Memulai Jumping:</h3>
                <p>Lompat rintangan (Show Jumping) bukan hanya soal kuda yang melompat, melainkan bagaimana rider membantu kuda menemukan titik lompat yang pas.</p>
                <ul>
                    <li><strong>Two-Point Position (Jumping Position):</strong> Posisi di mana berat badan didistribusikan hanya pada dua titik: lutut dan tumit. Pinggul diangkat sedikit dari pelana, dan dada condong ke depan. Latih posisi ini saat kuda sedang trot dan canter.</li>
                    <li><strong>Pengaturan Jarak (Distances):</strong> Pelajari cara membaca jarak (strides) antara kuda Anda dengan rintangan. Jangan biarkan kuda melompat terlalu dekat (deep) atau terlalu jauh (long).</li>
                    <li><strong>Release Tangan:</strong> Saat kuda berada di udara, tangan Anda harus didorong sedikit ke arah leher kuda untuk memberikan kebebasan pada mulut kuda agar lehernya bisa terentang sempurna saat melompat.</li>
                </ul>
            '
        ]);
    }
}