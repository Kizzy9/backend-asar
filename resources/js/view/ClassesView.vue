<template>
  <div class="container-classes">
    <div class="glass-card main-wrapper">
      <div class="header-section">
        <h2>Program Khusus: HBA Pemula</h2>
        <p class="subtitle">Perjalanan Anda dari nol hingga mampu mengendalikan kuda dan memanah.</p>
        
        <p v-if="isLoading" class="loading-text">Sedang memuat data terbaru dari server...</p>
      </div>

      <!-- Timeline Belajar untuk Pemula -->
      <div class="timeline-section mb-50">
        <h3 class="text-center mb-30" style="color: #fff;">Tahapan Belajar Anda</h3>
        <div class="timeline-grid">
          <div class="timeline-item">
            <div class="time-badge">Minggu 1</div>
            <h4>Pengenalan & Bonding</h4>
            <p>Mengenal kuda, cara mendekati, menyentuh, dan naik ke atas pelana dengan rileks. Anda akan didampingi instruktur 100%.</p>
          </div>
          <div class="timeline-item">
            <div class="time-badge">Minggu 2-3</div>
            <h4>Keseimbangan & Kontrol</h4>
            <p>Belajar postur tubuh yang benar, cara memberhentikan kuda, dan mengarahkan kuda berjalan santai (walk).</p>
          </div>
          <div class="timeline-item">
            <div class="time-badge">Bulan 1</div>
            <h4>Trot Dasar & Panahan Bawah</h4>
            <p>Mulai mencoba lari kecil (trot) dengan ritme yang aman, serta pengenalan alat panah (memanah dari tanah).</p>
          </div>
          <div class="timeline-item highlight-timeline">
            <div class="time-badge gold">Hasil Akhir</div>
            <h4>Penunggang Mandiri</h4>
            <p>Mampu menunggang dan mengendalikan kuda dengan tenang sendirian, serta siap untuk mulai menggabungkan panahan di atas kuda.</p>
          </div>
        </div>
      </div>

      <h3 class="category-title">🎯 Paket HBA Pemula</h3>
      <div class="class-grid">
        <div 
          v-for="item in hbaClasses" 
          :key="item.id" 
          :class="['class-item', { highlight: item.is_popular }]"
        >
          <div v-if="item.is_popular" class="badge">Rekomendasi</div>
          <h3>{{ item.title }}</h3>
          
          <div class="price-box">
            <template v-if="item.price_main">
              <span class="main-price">{{ item.price_main }}</span>
              <span class="detail">{{ item.price_detail }}</span>
            </template>
            <template v-else>
              <p>Weekday: <strong>{{ item.price_weekday }}</strong></p>
              <p v-if="item.price_weekend">Weekend: <strong>{{ item.price_weekend }}</strong></p>
            </template>
          </div>
          
          <p class="desc">{{ item.description }}</p>
          <button 
            :class="['btn-select', { 'highlight-btn': item.is_popular }]" 
            @click="selectPackage(item.title)"
          >
            Daftar Sekarang
          </button>
        </div>
      </div>

      <h3 class="category-title mt-50">🏆 Program Lanjutan (Equestrian)</h3>
      <p style="color: #aaa; margin-bottom: 20px; font-size: 14px;">Bagi Anda yang sudah menguasai dasar menunggang kuda dan ingin memperdalam disiplin Equestrian.</p>
      <div class="class-grid">
        <div 
          v-for="item in equestrianClasses" 
          :key="item.id" 
          class="class-item"
        >
          <h3>{{ item.title }}</h3>
          
          <div class="price-box">
            <p>Per Sesi: <strong>{{ item.price_main }}</strong></p>
          </div>
          
          <p class="desc">{{ item.description }}</p>
          <button class="btn-select" @click="selectPackage(item.title)">Daftar Sekarang</button>
        </div>
      </div>

      <div class="footer-note">
        <p>* Jadwal kelas fleksibel. Silakan hubungi admin untuk menentukan jadwal latihan pertama Anda.</p>
        <button class="btn-book" @click="contactAdmin">Hubungi Admin Via WA</button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import api from '../axios';

const router = useRouter();
const isLoading = ref(false);

// STATE DEFAULT
const classesData = ref([
  { id: 1, title: '🏹 Paket HBA Intensif (Pemula)', category: 'HBA', is_popular: true, price_main: 'Rp 2.000.000', price_detail: '8 Sesi @ 45 Menit', description: 'Program terbaik untuk pemula. Garansi bisa menunggang kuda mandiri di akhir sesi.' },
  { id: 2, title: '🐎 Beginner Riding (Per Sesi)', category: 'HBA', is_popular: false, price_weekday: '300.000', price_weekend: '350.000', description: 'Cocok untuk Anda yang ingin mencoba 1-2 sesi terlebih dahulu sebelum mengambil paket.' },
  { id: 3, title: '🏹 Shoot on Horse', category: 'HBA', is_popular: false, price_weekday: '300.000', price_weekend: '350.000', description: 'Latihan khusus teknik memanah di atas punggung kuda (Syarat: sudah lulus Beginner).' },
  { id: 4, title: '👥 Group Class', category: 'HBA', is_popular: false, price_weekday: '300.000', price_weekend: '350.000', description: 'Latihan bersama teman/keluarga dalam satu grup. Maksimal 3 orang.' },
  { id: 5, title: '🏇 Practice Riding', category: 'HBA', is_popular: false, price_weekday: '200.000', price_weekend: '250.000', description: 'Latihan mandiri (Tanpa Pelatih) bagi yang sudah mahir.' },
  
  { id: 6, title: '🏜️ Endurance', category: 'Equestrian', price_main: 'Rp 500.000', description: 'Latihan ketahanan fisik dan stamina kuda jarak jauh.' },
  { id: 7, title: '🎖️ Equestrian (Dressage)', category: 'Equestrian', price_main: 'Rp 600.000', description: 'Seni kemahiran berkuda, harmoni, dan keanggunan.' },
  { id: 8, title: '🏆 Show Jumping', category: 'Equestrian', price_main: 'Rp 750.000', description: 'Teknik melompati rintangan dengan akurasi tinggi.' }
]);

const fetchClassesFromBackend = async () => {
  try {
    isLoading.value = true;
    const response = await api.get('/classes');
    if (response.data && response.data.length > 0) {
      classesData.value = response.data.data || response.data;
    }
  } catch (error) {
    console.error("Gagal mengambil data kelas, menggunakan data default.", error);
  } finally {
    isLoading.value = false;
  }
};

const hbaClasses = computed(() => {
  return classesData.value.filter(c => c.category === 'HBA');
});

const equestrianClasses = computed(() => {
  return classesData.value.filter(c => c.category === 'Equestrian');
});

onMounted(() => {
  fetchClassesFromBackend();
});

const contactAdmin = () => {
  window.open('https://wa.me/6282364366595', '_blank');
}

const selectPackage = (packageName) => {
  router.push({ name: 'registration', query: { package: packageName } });
}
</script>

<style scoped>
.container-classes {
  width: 100%;
  display: flex;
  justify-content: center;
  padding: 20px;
}

.text-center { text-align: center; }
.mb-30 { margin-bottom: 30px; }
.mb-50 { margin-bottom: 50px; }
.mt-50 { margin-top: 50px; }

.main-wrapper {
  background: rgba(0, 0, 0, 0.75);
  backdrop-filter: blur(15px);
  border: 1px solid rgba(226, 199, 146, 0.3);
  border-radius: 30px;
  padding: 50px 40px;
  max-width: 1100px;
  width: 100%;
  box-shadow: 0 25px 50px rgba(0,0,0,0.5);
}

.header-section {
  text-align: center;
  margin-bottom: 50px;
}

h2 {
  color: #E2C792;
  font-size: 40px;
  text-transform: uppercase;
  letter-spacing: 2px;
  margin-bottom: 15px;
  text-shadow: 2px 2px 10px rgba(0,0,0,0.5);
}

.subtitle { color: #ccc; font-size: 18px; }
.loading-text { color: #E2C792; font-size: 14px; margin-top: 15px; font-style: italic; animation: pulse 1.5s infinite; }

@keyframes pulse {
  0% { opacity: 0.5; }
  50% { opacity: 1; }
  100% { opacity: 0.5; }
}

/* Timeline Section */
.timeline-section {
  background: rgba(255, 255, 255, 0.03);
  padding: 40px;
  border-radius: 20px;
  border: 1px solid rgba(255, 255, 255, 0.05);
}

.timeline-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 20px;
}

.timeline-item {
  background: rgba(0, 0, 0, 0.4);
  padding: 25px 20px;
  border-radius: 12px;
  text-align: center;
  position: relative;
}

.highlight-timeline {
  border: 1px solid #E2C792;
  background: rgba(226, 199, 146, 0.05);
}

.time-badge {
  display: inline-block;
  background: #333;
  color: #fff;
  padding: 5px 15px;
  border-radius: 20px;
  font-size: 12px;
  font-weight: bold;
  margin-bottom: 15px;
}

.time-badge.gold {
  background: #E2C792;
  color: #000;
}

.timeline-item h4 {
  color: #fff;
  font-size: 16px;
  margin-bottom: 10px;
}

.timeline-item p {
  color: #aaa;
  font-size: 13px;
  line-height: 1.5;
}

/* Category & Classes */
.category-title {
  color: #E2C792;
  font-size: 24px;
  border-bottom: 2px solid #E2C792;
  display: inline-block;
  margin-bottom: 30px;
  padding-bottom: 5px;
}

.class-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 25px;
}

.class-item {
  background: rgba(255, 255, 255, 0.05);
  border: 1px solid rgba(255, 255, 255, 0.1);
  padding: 30px;
  border-radius: 20px;
  position: relative;
  transition: all 0.3s ease;
  overflow: hidden;
  display: flex;
  flex-direction: column;
}

.class-item:hover {
  background: rgba(226, 199, 146, 0.1);
  transform: translateY(-10px);
  border-color: #E2C792;
}

.highlight {
  border: 2px solid #E2C792;
  background: rgba(226, 199, 146, 0.15);
}

.badge {
  position: absolute;
  top: 15px;
  right: -30px;
  background: #E2C792;
  color: #000;
  padding: 5px 40px;
  transform: rotate(45deg);
  font-size: 12px;
  font-weight: bold;
  text-transform: uppercase;
}

h3 { color: #fff; font-size: 22px; margin-bottom: 15px; }

.price-box {
  background: rgba(0, 0, 0, 0.3);
  padding: 15px;
  border-radius: 12px;
  margin-bottom: 15px;
}

.price-box p {
  font-size: 15px;
  margin-bottom: 5px;
  display: flex;
  justify-content: space-between;
}

.price-box strong { color: #E2C792; font-size: 18px; }

.main-price {
  display: block;
  font-size: 28px;
  font-weight: bold;
  color: #E2C792;
}

.detail { font-size: 14px; color: #aaa; }

.desc {
  font-size: 14px;
  line-height: 1.5;
  color: #ddd;
  margin-bottom: 20px;
  flex-grow: 1;
}

.btn-select {
  width: 100%;
  padding: 12px;
  background: transparent;
  border: 1px solid #E2C792;
  color: #E2C792;
  border-radius: 10px;
  font-size: 14px;
  font-weight: bold;
  cursor: pointer;
  transition: all 0.3s ease;
  margin-top: auto;
}

.btn-select:hover {
  background: #E2C792;
  color: #000;
  box-shadow: 0 5px 15px rgba(226, 199, 146, 0.3);
}

.highlight-btn { background: #E2C792; color: #000; }
.highlight-btn:hover { background: #cba86a; border-color: #cba86a; }

.footer-note { margin-top: 50px; text-align: center; }
.footer-note p { font-size: 14px; color: #bbb; margin-bottom: 20px; }

.btn-book {
  background: linear-gradient(45deg, #E2C792, #9E7E4F);
  color: #000;
  border: none;
  padding: 15px 40px;
  border-radius: 50px;
  font-size: 16px;
  font-weight: bold;
  cursor: pointer;
  transition: 0.3s;
  box-shadow: 0 10px 20px rgba(158, 126, 79, 0.3);
}

.btn-book:hover {
  transform: scale(1.05);
  box-shadow: 0 15px 30px rgba(158, 126, 79, 0.5);
}

@media (max-width: 768px) {
  .main-wrapper { padding: 30px 20px; }
  h2 { font-size: 28px; }
  .class-grid, .timeline-grid { grid-template-columns: 1fr; }
}
</style>