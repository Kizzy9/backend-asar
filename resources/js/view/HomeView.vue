<template>
  <div class="home-container">
    
    <!-- Hero Section -->
    <div class="hero-section">
      <h1 class="main-title">Mulai Berkuda Tanpa Rasa Takut</h1>
      <p class="subtitle">
        Aman, didampingi instruktur bersertifikat, dan tidak perlu pengalaman sama sekali. 
        Temukan ketenangan dan kekuatan baru di Ashabul Husna Ranch.
      </p>
      <div class="hero-buttons">
        <router-link to="/about" class="btn-primary">Kenal Lebih Dekat</router-link>
        <router-link to="/classes" class="btn-outline">Lihat Program</router-link>
      </div>
    </div>

    <!-- Visual / Vibe Section (Placeholder for Video/Image) -->
    <div class="vibe-section glass-card">
      <div class="video-placeholder">
        <div class="play-btn">▶</div>
        <p>Lihat suasana tenang Ashabul Husna Ranch</p>
      </div>
    </div>

    <!-- Testimoni Singkat -->
    <div class="testimonial-section glass-card">
      <h2 class="section-title">Cerita Mereka yang Pernah Ragu</h2>
      <div class="testi-grid">
        <div class="testi-item">
          <p class="quote">"Awalnya saya takut setengah mati karena belum pernah dekat kuda. Tapi instruktur di ASAR sangat sabar menuntun dari nol. Sekarang saya malah ketagihan!"</p>
          <p class="author">- Andi, 28 Tahun (Program HBA Pemula)</p>
        </div>
        <div class="testi-item">
          <p class="quote">"Suasananya sangat tenang. Lebih dari sekadar olahraga, rasanya seperti terapi mental setelah seminggu lelah bekerja."</p>
          <p class="author">- Sarah, 34 Tahun (Program HBA Pemula)</p>
        </div>
      </div>
    </div>

    <!-- FAQ Singkat -->
    <div class="faq-section glass-card">
      <h2 class="section-title">Pertanyaan Sering Muncul (FAQ)</h2>
      <div class="faq-list">
        <div class="faq-item">
          <h3>Apakah aman untuk pemula yang belum pernah naik kuda?</h3>
          <p>Sangat aman. Kuda kami terlatih khusus untuk pemula dan Anda akan selalu didampingi instruktur bersertifikat di dalam arena.</p>
        </div>
        <div class="faq-item">
          <h3>Apakah ada batasan usia dan berat badan?</h3>
          <p>Untuk kelas dewasa, minimal usia 12 tahun. Maksimal berat badan penunggang adalah 85 kg demi kesejahteraan kuda kami.</p>
        </div>
        <div class="faq-item">
          <h3>Bagaimana kalau di tengah sesi saya tiba-tiba takut?</h3>
          <p>Tidak masalah! Instruktur kami mengutamakan kenyamanan mental Anda. Kita bisa berhenti sejenak, melatih pernapasan, atau sekadar berinteraksi dengan kuda dari bawah.</p>
        </div>
      </div>
    </div>

    <!-- CTA Section -->
    <div class="cta-section">
      <h3>Siap Memulai Perjalanan Anda?</h3>
      <p>Pilih kelas yang sesuai atau konsultasi dulu dengan kami.</p>
      <router-link to="/classes" class="btn-gold">Mulai Latihan</router-link>
    </div>

  </div>
</template>

<style scoped>
.home-container {
  width: 100%;
  max-width: 1100px;
  margin: 0 auto;
  padding: 20px;
  display: flex;
  flex-direction: column;
  gap: 60px;
}

/* --- Hero Section --- */
.hero-section {
  text-align: center;
  padding: 80px 0 40px 0;
  animation: fadeInDown 1s ease;
  max-width: 800px;
  margin: 0 auto;
}

.main-title {
  font-size: 56px;
  font-weight: 700;
  color: #fff;
  letter-spacing: -1px;
  margin-bottom: 20px;
  line-height: 1.2;
}

.subtitle {
  font-size: 20px;
  color: #E2C792;
  margin-bottom: 40px;
  font-weight: 400;
  line-height: 1.6;
}

.hero-buttons {
  display: flex;
  gap: 20px;
  justify-content: center;
}

.btn-primary {
  display: inline-block;
  padding: 16px 40px;
  background: #E2C792;
  color: #000;
  text-decoration: none;
  border-radius: 8px;
  font-weight: 600;
  font-size: 16px;
  transition: all 0.3s ease;
}

.btn-primary:hover {
  background: #fff;
  transform: translateY(-3px);
  box-shadow: 0 10px 20px rgba(255, 255, 255, 0.2);
}

.btn-outline {
  display: inline-block;
  padding: 16px 40px;
  background: transparent;
  color: #E2C792;
  text-decoration: none;
  border: 2px solid #E2C792;
  border-radius: 8px;
  font-weight: 600;
  font-size: 16px;
  transition: all 0.3s ease;
}

.btn-outline:hover {
  background: rgba(226, 199, 146, 0.1);
  transform: translateY(-3px);
}

/* --- Glass Card Style --- */
.glass-card {
  background: rgba(20, 20, 20, 0.6);
  backdrop-filter: blur(20px);
  -webkit-backdrop-filter: blur(20px);
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-radius: 16px;
  padding: 50px;
  box-shadow: 0 15px 35px rgba(0,0,0,0.3);
}

.section-title {
  color: #fff;
  font-size: 32px;
  font-weight: 700;
  margin-bottom: 40px;
  text-align: center;
}

/* --- Vibe Section --- */
.video-placeholder {
  width: 100%;
  height: 400px;
  background: rgba(0, 0, 0, 0.4);
  border-radius: 12px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  color: #aaa;
  border: 1px dashed rgba(226, 199, 146, 0.4);
  cursor: pointer;
  transition: all 0.3s;
}

.video-placeholder:hover {
  background: rgba(0, 0, 0, 0.6);
  border-color: #E2C792;
}

.play-btn {
  font-size: 50px;
  color: #E2C792;
  margin-bottom: 15px;
}

/* --- Testimonial Section --- */
.testi-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 30px;
}

.testi-item {
  background: rgba(255, 255, 255, 0.03);
  padding: 30px;
  border-radius: 12px;
  border-left: 4px solid #E2C792;
}

.quote {
  font-size: 16px;
  color: #ddd;
  font-style: italic;
  line-height: 1.6;
  margin-bottom: 20px;
}

.author {
  color: #E2C792;
  font-weight: 600;
  font-size: 14px;
}

/* --- FAQ Section --- */
.faq-list {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.faq-item {
  background: rgba(255, 255, 255, 0.03);
  padding: 25px 30px;
  border-radius: 12px;
  border: 1px solid rgba(255, 255, 255, 0.05);
}

.faq-item h3 {
  color: #E2C792;
  font-size: 18px;
  margin-bottom: 10px;
}

.faq-item p {
  color: #ccc;
  line-height: 1.6;
  font-size: 15px;
}

/* --- CTA Section --- */
.cta-section {
  text-align: center;
  padding: 40px 0 80px;
}

.cta-section h3 {
  font-size: 32px;
  color: #fff;
  margin-bottom: 15px;
  font-weight: 700;
}

.cta-section p {
  color: #bbb;
  margin-bottom: 35px;
  font-size: 16px;
}

.btn-gold {
  display: inline-block;
  padding: 16px 45px;
  background: #E2C792;
  color: #000;
  text-decoration: none;
  border-radius: 8px;
  font-weight: 600;
  font-size: 16px;
  transition: all 0.3s ease;
}

.btn-gold:hover {
  background: #fff;
  transform: translateY(-3px);
  box-shadow: 0 10px 20px rgba(255, 255, 255, 0.15);
}

@keyframes fadeInDown {
  from { opacity: 0; transform: translateY(-20px); }
  to { opacity: 1; transform: translateY(0); }
}

@media (max-width: 768px) {
  .main-title { font-size: 40px; }
  .hero-buttons { flex-direction: column; }
  .glass-card { padding: 30px 20px; }
  .video-placeholder { height: 250px; }
}
</style>