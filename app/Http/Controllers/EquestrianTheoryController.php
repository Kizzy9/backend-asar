<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EquestrianTheoryController extends Controller
{
    public function index()
    {
        // Data artikel edukasi equestrian yang kaya dan terstruktur
        $theories = [
            [
                'id' => 1,
                'title' => 'Mengenal Bridle Horse dan Fungsinya',
                'date' => '15 January, 2024',
                'excerpt' => 'Bridle Horse mungkin terdengar seperti istilah yang asing bagi sebagian orang, tetapi sebenarnya, ini adalah konsep yang mendalam dalam dunia berkuda. Namun, tahukah Anda apa itu Bridle Horse? Berikut penjelasannya...',
                'content' => '<p>Bridle Horse merujuk pada tingkatan keahlian tertentu yang dicapai oleh kuda dan penunggangnya. Bridle adalah bagian dari perlengkapan berkuda (tack) yang dikenakan di kepala kuda, berfungsi untuk memberikan kendali penuh kepada penunggang melalui bit (besi yang masuk ke mulut kuda) dan reins (tali kekang).</p><br><p>Proses melatih kuda menjadi "Bridle Horse" memakan waktu bertahun-tahun. Dimulai dari menggunakan halter biasa, snaffle bit, hingga akhirnya menggunakan bridle penuh. Kuda yang sudah mencapai tahap ini sangat responsif terhadap isyarat tubuh (seat and leg aids) penunggangnya, sehingga gerakan tangan hampir tidak terlihat. Ini adalah puncak keharmonisan antara manusia dan kuda.</p>',
                'image_url' => 'https://images.unsplash.com/photo-1598974357801-cbca100e65d3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ],
            [
                'id' => 2,
                'title' => 'Punya Masalah Saat Riding? Ikuti Tips Berikut Ini',
                'date' => '20 February, 2024',
                'excerpt' => 'Bagi sebagian orang, mungkin menghadapi kendala saat berkuda adalah hal yang lumrah. Namun, jangan khawatir! Intip tips berikut ini untuk memperbaiki keseimbangan Anda di atas pelana...',
                'content' => '<p>Masalah paling umum saat riding adalah hilangnya keseimbangan dan kuda yang tidak mau maju. Berikut adalah beberapa tips dasar untuk mengatasinya:</p><br><ul><li><strong>Perbaiki Postur:</strong> Duduk tegak di bagian terdalam pelana, bahu ditarik ke belakang, dan tumit menekan ke bawah (heels down). Postur yang baik adalah kunci keseimbangan.</li><br><li><strong>Rileks:</strong> Kuda bisa merasakan ketegangan Anda. Tarik napas dalam-dalam dan lemaskan otot-otot pinggul Anda agar bisa mengikuti ritme langkah kuda.</li><br><li><strong>Fokus ke Depan:</strong> Jangan terus-menerus menunduk melihat leher kuda. Lihat lurus ke arah mana Anda ingin pergi.</li><br><li><strong>Komunikasi Jelas:</strong> Gunakan betis Anda untuk memberi isyarat maju dengan mantap, jangan hanya mengandalkan tarikan tali kekang.</li></ul>',
                'image_url' => 'https://images.unsplash.com/photo-1553284965-83fd3e82fa5a?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ],
            [
                'id' => 3,
                'title' => 'Bahasa Tubuh Kuda: Memahami Perasaan Kuda Anda',
                'date' => '10 March, 2024',
                'excerpt' => 'Kuda berkomunikasi melalui bahasa tubuh yang sangat halus. Memahami sinyal-sinyal ini penting untuk keamanan dan membangun ikatan batin antara penunggang dan kuda...',
                'content' => '<p>Sebelum Anda menunggangi kuda, sangat penting untuk membaca suasana hatinya melalui bahasa tubuh. Berikut adalah panduan singkatnya:</p><br><ul><li><strong>Telinga:</strong> Telinga ke depan berarti waspada atau tertarik. Telinga ditarik rata ke belakang leher (pinned back) berarti marah, terancam, atau agresif—berhati-hatilah!</li><br><li><strong>Mata & Hidung:</strong> Mata yang membulat membelalak dan lubang hidung yang kembang kempis sering kali menandakan ketakutan atau panik terhadap objek baru.</li><br><li><strong>Ekor:</strong> Ekor yang dikibas-kibaskan dengan keras ke kiri dan kanan biasanya menandakan iritasi (misalnya karena lalat) atau ketidaksenangan terhadap sesuatu yang Anda lakukan.</li><br><li><strong>Kaki:</strong> Jika kuda terus-menerus menghentakkan kaki depannya (pawing) ke tanah, ia mungkin sedang tidak sabar, bosan, atau frustrasi.</li></ul>',
                'image_url' => 'https://images.unsplash.com/photo-1518331647614-7a1f04cd34cf?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ]
        ];

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil data materi equestrian.',
            'data' => $theories
        ], 200);
    }
}