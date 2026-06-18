<template>
  <div class="not-ready-container">
    
    <div class="glass-card main-content">
      <h1 class="main-title text-center">Merasa Takut atau Ragu? <br/><span class="highlight">Itu Sangat Wajar.</span></h1>
      
      <p class="intro-text text-center mt-30">
        Banyak orang mengira bahwa semua penunggang kuda terlahir berani. Faktanya, hampir 100% murid pemula kami 
        merasakan jantung berdebar kencang saat pertama kali berdiri di sebelah kuda.
      </p>

      <!-- Validasi & Bingkai Religius -->
      <div class="framing-section mt-40">
        <div class="icon-box">🤍</div>
        <h2>Niatkan Sebagai Ibadah Kecil</h2>
        <p>
          Takut mencoba hal baru, apalagi yang melibatkan hewan besar, bukanlah sebuah kelemahan. 
          Namun, mari kita ubah sudut pandangnya. Dalam Islam, mempelajari keterampilan yang bermanfaat seperti berkuda 
          sangat dianjurkan. 
        </p>
        <p>
          Langkah kecil Anda mengalahkan rasa takut untuk belajar hal baru ini, dengan niat yang baik, 
          sudah dihitung sebagai sebuah ibadah. Anda tidak dituntut untuk langsung mahir atau berani berlari kencang.
          Cukup datang, lihat, dan rasakan.
        </p>
      </div>

      <!-- Tips Persiapan -->
      <div class="tips-section mt-50">
        <h2 class="text-center mb-30">Tips Ringan Sebelum Memulai</h2>
        
        <div class="tips-grid">
          <div class="tip-card">
            <span class="number">1</span>
            <h3>Datang Lebih Awal</h3>
            <p>Jangan terburu-buru langsung naik. Datanglah 30 menit lebih awal, lihat orang lain berlatih, dan biasakan diri dengan suasana ranch.</p>
          </div>
          
          <div class="tip-card">
            <span class="number">2</span>
            <h3>Sapa Kuda dari Bawah</h3>
            <p>Instruktur kami akan mengajarkan cara mendekati kuda dengan aman. Memberi makan atau sekadar mengusap lehernya sangat ampuh meredakan ketegangan.</p>
          </div>
          
          <div class="tip-card">
            <span class="number">3</span>
            <h3>Fokus pada Napas</h3>
            <p>Kuda bisa merasakan detak jantung Anda. Saat di atas pelana, pejamkan mata sejenak, tarik napas panjang, dan biarkan instruktur yang memegang tali kuda Anda.</p>
          </div>
        </div>
      </div>

      <!-- CTA Consultation -->
      <div class="cta-consultation mt-60">
        <h3>Jangan Biarkan Keraguan Menghentikan Anda</h3>
        <p>Kami sangat terbuka untuk berdiskusi. Anda bisa ngobrol santai dulu dengan instruktur kami melalui WhatsApp tanpa kewajiban untuk mendaftar kelas.</p>
        
        <a href="https://wa.me/6282364366595?text=Halo%20Instruktur%20ASAR,%20saya%20tertarik%20belajar%20kuda%20tapi%20jujur%20masih%20agak%20takut.%20Boleh%20konsultasi%20dulu?" 
           target="_blank" class="btn-wa">
           Konsultasi Gratis via WhatsApp
        </a>

        <div class="or-divider">
          <span>ATAU</span>
        </div>

        <router-link to="/classes" class="link-classes">Saya berubah pikiran, saya berani mencoba programnya!</router-link>
      </div>

    </div>
  </div>
</template>

<style scoped>
.not-ready-container {
  width: 100%;
  max-width: 900px;
  margin: 0 auto;
  padding: 40px 20px;
}

.text-center { text-align: center; }
.mt-30 { margin-top: 30px; }
.mt-40 { margin-top: 40px; }
.mt-50 { margin-top: 50px; }
.mt-60 { margin-top: 60px; }
.mb-30 { margin-bottom: 30px; }

.glass-card {
  background: rgba(20, 20, 20, 0.7);
  backdrop-filter: blur(25px);
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-top: 4px solid #E2C792;
  border-radius: 20px;
  padding: 60px 50px;
  box-shadow: 0 20px 50px rgba(0,0,0,0.5);
}

.main-title {
  color: #fff;
  font-size: 42px;
  font-weight: 700;
  line-height: 1.3;
}

.highlight {
  color: #E2C792;
}

.intro-text {
  color: #bbb;
  font-size: 18px;
  line-height: 1.7;
  max-width: 700px;
  margin-left: auto;
  margin-right: auto;
}

/* Framing Section */
.framing-section {
  background: rgba(255, 255, 255, 0.03);
  padding: 40px;
  border-radius: 16px;
  position: relative;
  border-left: 2px solid rgba(226, 199, 146, 0.5);
}

.icon-box {
  font-size: 40px;
  margin-bottom: 15px;
}

.framing-section h2 {
  color: #fff;
  font-size: 24px;
  margin-bottom: 15px;
}

.framing-section p {
  color: #ccc;
  line-height: 1.7;
  font-size: 16px;
  margin-bottom: 15px;
}

/* Tips Section */
.tips-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 25px;
}

.tip-card {
  background: rgba(0, 0, 0, 0.4);
  padding: 30px 25px;
  border-radius: 12px;
  border: 1px solid rgba(255, 255, 255, 0.05);
  position: relative;
  text-align: center;
  transition: transform 0.3s;
}

.tip-card:hover {
  transform: translateY(-5px);
  border-color: rgba(226, 199, 146, 0.3);
}

.number {
  display: inline-block;
  width: 40px;
  height: 40px;
  line-height: 40px;
  background: #E2C792;
  color: #000;
  border-radius: 50%;
  font-weight: bold;
  font-size: 20px;
  margin-bottom: 15px;
}

.tip-card h3 {
  color: #E2C792;
  font-size: 18px;
  margin-bottom: 15px;
}

.tip-card p {
  color: #aaa;
  font-size: 14px;
  line-height: 1.6;
}

/* CTA Consultation */
.cta-consultation {
  text-align: center;
  padding-top: 40px;
  border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.cta-consultation h3 {
  color: #fff;
  font-size: 26px;
  margin-bottom: 15px;
}

.cta-consultation p {
  color: #bbb;
  margin-bottom: 30px;
}

.btn-wa {
  display: inline-block;
  background: #25D366; /* Warna khas WhatsApp */
  color: #fff;
  padding: 16px 40px;
  border-radius: 50px;
  text-decoration: none;
  font-weight: bold;
  font-size: 16px;
  box-shadow: 0 10px 20px rgba(37, 211, 102, 0.2);
  transition: all 0.3s;
}

.btn-wa:hover {
  transform: translateY(-3px);
  box-shadow: 0 15px 25px rgba(37, 211, 102, 0.4);
}

.or-divider {
  margin: 30px 0;
  position: relative;
}

.or-divider::before {
  content: '';
  position: absolute;
  top: 50%;
  left: 20%;
  right: 20%;
  height: 1px;
  background: rgba(255, 255, 255, 0.1);
  z-index: 1;
}

.or-divider span {
  background: #1a1a1a;
  padding: 0 15px;
  color: #666;
  font-size: 14px;
  position: relative;
  z-index: 2;
}

.link-classes {
  color: #E2C792;
  text-decoration: underline;
  font-size: 15px;
  transition: color 0.3s;
}

.link-classes:hover {
  color: #fff;
}

@media (max-width: 768px) {
  .glass-card { padding: 40px 25px; }
  .main-title { font-size: 32px; }
  .tips-grid { grid-template-columns: 1fr; }
  .or-divider::before { left: 0; right: 0; }
}
</style>
