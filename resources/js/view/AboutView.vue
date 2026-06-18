<template>
  <div class="about-container">
    
    <!-- Header Section -->
    <div class="header-section text-center">
      <h1 class="main-title">Tentang Ashabul Husna Ranch</h1>
      <p class="subtitle">Lebih dari sekadar arena berkuda. Kami adalah rumah untuk bertumbuh.</p>
    </div>

    <!-- Story & Values -->
    <div class="glass-card story-section">
      <div class="content-text">
        <h2 class="section-title">Cerita di Balik Nama</h2>
        <p>
          "Ashabul Husna" berarti orang-orang yang memiliki kebaikan. Nama ini adalah doa sekaligus visi kami: 
          menjadikan arena ini tempat di mana setiap orang, dari anak-anak hingga dewasa, dapat melatih ketahanan fisik 
          sekaligus ketenangan jiwa.
        </p>
        
        <h3 class="sub-heading mt-30">Menghidupkan Budaya Ksatria</h3>
        <p>
          Dalam tradisi kebudayaan Islam, aktivitas fisik seperti berenang, memanah, dan menunggang kuda memiliki tempat yang sangat istimewa. 
          Bahkan sahabat Nabi, Umar bin Khattab, sangat menganjurkan orang tua untuk mengajarkan keterampilan ini kepada anak-anak mereka. 
        </p>
        <p>
          Bukan sekadar olahraga, berkuda melatih empati (karena kita berinteraksi dengan makhluk hidup), melatih kepemimpinan (mengendalikan kuda), 
          dan melatih fokus. Inilah semangat yang kami bawa di setiap sesi latihan.
        </p>
      </div>
    </div>

    <!-- Instruktur & Fasilitas -->
    <div class="glass-card facility-section mt-40">
      <h2 class="section-title text-center">Keamanan & Keahlian yang Bisa Anda Andalkan</h2>
      
      <div class="grid-2">
        <div class="card-item">
          <div class="icon">🏆</div>
          <h3>Instruktur Bersertifikat</h3>
          <p>
            Semua pelatih di ASAR telah melewati pelatihan intensif dan memiliki sertifikasi dalam penanganan kuda serta keselamatan berkuda. 
            Mereka dilatih khusus untuk memahami psikologi pemula yang seringkali merasa gugup.
          </p>
        </div>
        
        <div class="card-item">
          <div class="icon">🛡️</div>
          <h3>Kuda Latih Khusus Pemula</h3>
          <p>
            Tidak semua kuda cocok untuk pemula. Kami memiliki kuda-kuda (schoolmaster) yang memiliki temperamen sangat tenang dan sabar, 
            sehingga meminimalisir risiko bagi mereka yang baru pertama kali naik kuda.
          </p>
        </div>
        
        <div class="card-item">
          <div class="icon">🏡</div>
          <h3>Arena Tertutup & Terbuka</h3>
          <p>
            Fasilitas kami mencakup arena berpasir yang aman dan bersih, serta area *paddock* tempat Anda bisa belajar cara merawat, 
            menyikat, dan membangun ikatan dengan kuda sebelum mulai menunggang.
          </p>
        </div>

        <div class="card-item">
          <div class="icon">🏹</div>
          <h3>Fasilitas Panahan Berkuda</h3>
          <p>
            Bagi yang ingin melangkah lebih jauh, kami menyediakan jalur panahan (track HBA) yang didesain sesuai standar keselamatan internasional.
          </p>
        </div>
      </div>
    </div>

    <!-- Branching Decision (The "Crossroads") -->
    <div class="decision-section mt-60">
      <h2 class="decision-title">Sekarang Keputusan Ada di Tangan Anda</h2>
      <p class="decision-desc">
        Setelah mengetahui fasilitas dan dukungan yang kami berikan, bagaimana perasaan Anda untuk memulai kelas pertama?
      </p>

      <div class="decision-cards">
        <div class="decision-card ready-card">
          <h3>"Saya Sudah Siap!"</h3>
          <p>Saya ingin melihat jadwal, harga, dan tahapan belajar untuk pemula.</p>
          <router-link to="/classes" class="btn-solid">Lihat Program & Harga</router-link>
        </div>

        <div class="decision-card not-ready-card">
          <h3>"Saya Masih Ragu / Takut"</h3>
          <p>Wajar sekali. Mari kita bicarakan apa yang membuat Anda ragu sebelum memutuskan.</p>
          <router-link to="/belum-siap" class="btn-outline-white">Baca Ini Dulu</router-link>
        </div>
      </div>
    </div>

  </div>
</template>

<style scoped>
.about-container {
  width: 100%;
  max-width: 1000px;
  margin: 0 auto;
  padding: 20px 20px 80px;
}

.text-center { text-align: center; }
.mt-30 { margin-top: 30px; }
.mt-40 { margin-top: 40px; }
.mt-60 { margin-top: 60px; }

.header-section {
  padding: 60px 0 40px;
}

.main-title {
  font-size: 48px;
  color: #fff;
  font-weight: 700;
  margin-bottom: 15px;
}

.subtitle {
  font-size: 18px;
  color: #E2C792;
}

/* Glass Card */
.glass-card {
  background: rgba(20, 20, 20, 0.6);
  backdrop-filter: blur(20px);
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-radius: 16px;
  padding: 50px;
  box-shadow: 0 15px 35px rgba(0,0,0,0.3);
}

.section-title {
  color: #E2C792;
  font-size: 28px;
  margin-bottom: 20px;
  font-weight: 700;
}

.sub-heading {
  color: #fff;
  font-size: 20px;
  margin-bottom: 15px;
}

p {
  color: #ccc;
  line-height: 1.7;
  margin-bottom: 15px;
  font-size: 16px;
}

/* Facility Grid */
.grid-2 {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
  gap: 30px;
  margin-top: 30px;
}

.card-item {
  background: rgba(255, 255, 255, 0.03);
  padding: 30px;
  border-radius: 12px;
  border-top: 3px solid #E2C792;
}

.card-item .icon {
  font-size: 35px;
  margin-bottom: 15px;
}

.card-item h3 {
  color: #fff;
  margin-bottom: 10px;
  font-size: 18px;
}

.card-item p {
  font-size: 14px;
  color: #aaa;
}

/* Decision Section */
.decision-section {
  text-align: center;
  background: linear-gradient(135deg, rgba(226, 199, 146, 0.1), rgba(0,0,0,0));
  border: 1px solid rgba(226, 199, 146, 0.2);
  border-radius: 16px;
  padding: 60px 40px;
}

.decision-title {
  color: #fff;
  font-size: 32px;
  margin-bottom: 15px;
}

.decision-desc {
  color: #bbb;
  margin-bottom: 40px;
}

.decision-cards {
  display: flex;
  justify-content: center;
  gap: 30px;
  flex-wrap: wrap;
}

.decision-card {
  flex: 1;
  min-width: 300px;
  padding: 40px 30px;
  border-radius: 12px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  align-items: center;
}

.decision-card h3 {
  font-size: 22px;
  margin-bottom: 15px;
}

.decision-card p {
  font-size: 14px;
  text-align: center;
  margin-bottom: 30px;
}

.ready-card {
  background: rgba(226, 199, 146, 0.15);
  border: 1px solid rgba(226, 199, 146, 0.5);
}
.ready-card h3 { color: #E2C792; }

.not-ready-card {
  background: rgba(255, 255, 255, 0.05);
  border: 1px solid rgba(255, 255, 255, 0.2);
}
.not-ready-card h3 { color: #fff; }

.btn-solid {
  background: #E2C792;
  color: #000;
  padding: 14px 30px;
  border-radius: 8px;
  text-decoration: none;
  font-weight: bold;
  width: 100%;
  transition: 0.3s;
}
.btn-solid:hover { background: #fff; }

.btn-outline-white {
  background: transparent;
  color: #fff;
  border: 1px solid #fff;
  padding: 14px 30px;
  border-radius: 8px;
  text-decoration: none;
  font-weight: bold;
  width: 100%;
  transition: 0.3s;
}
.btn-outline-white:hover {
  background: #fff;
  color: #000;
}

@media (max-width: 768px) {
  .main-title { font-size: 36px; }
  .glass-card { padding: 30px 20px; }
  .grid-2 { grid-template-columns: 1fr; }
  .decision-cards { flex-direction: column; }
}
</style>
