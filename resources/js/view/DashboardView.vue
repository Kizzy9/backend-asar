<template>
  <div class="dashboard-wrapper">
    
    <div v-if="!selectedTheory" class="glass-container">
      <div class="header-section">
        <h2>Modul Teori Berkuda</h2>
        <p>Pelajari fundamental equestrian sebelum Anda naik ke pelana.</p>
      </div>

      <div v-if="isLoading" class="loading-state">
        <span class="spinner">🐴</span>
        <p>Menarik data modul dari server...</p>
      </div>

      <div v-else class="theory-grid">
        <div 
          v-for="theory in theories" 
          :key="theory.id" 
          class="theory-card"
        >
          <div class="card-image">
            <img :src="theory.image_url || 'https://images.unsplash.com/photo-1553284965-83fd3e82fa5a?auto=format&fit=crop&w=600&q=80'" :alt="theory.title">
          </div>
          <div class="card-content">
            <span class="badge">Modul {{ theory.id }}</span>
            <h3>{{ theory.title }}</h3>
            <p>{{ theory.excerpt }}</p>
            <button @click="openTheory(theory)" class="btn-read">
              Mulai Belajar ➔
            </button>
          </div>
        </div>
      </div>
      
      <div v-if="!isLoading && theories.length === 0" class="empty-state">
        <p>Belum ada modul teori yang tersedia saat ini.</p>
      </div>
    </div>

    <div v-else class="glass-container detail-view">
      <button @click="closeTheory" class="btn-back">
        ⬅ Kembali ke Daftar Modul
      </button>

      <div class="theory-header">
        <h1>{{ selectedTheory.title }}</h1>
        <p class="theory-meta">Dipublikasikan oleh Instruktur Asar Stable</p>
      </div>

      <div class="theory-body html-content" v-html="selectedTheory.content"></div>
      
      <div class="theory-footer">
        <button @click="closeTheory" class="btn-finish">Selesai Membaca</button>
      </div>
    </div>

  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import api from '../axios'; // Pastikan path ini sesuai dengan file axios Anda

const theories = ref([]);
const isLoading = ref(true);
const selectedTheory = ref(null);

// Fungsi untuk mengambil data dari Backend Laravel Anda
const fetchTheories = async () => {
  isLoading.value = true;
  try {
    // Pastikan endpoint '/teori' ini sudah Anda buat di rute API (api.php) Laravel Anda
    const response = await api.get('/teori'); 
    
    // Asumsi response backend: { success: true, data: [...] }
    if (response.data && response.data.data) {
      theories.value = response.data.data;
    } else {
      theories.value = response.data; // Fallback jika struktur datanya langsung array
    }
  } catch (error) {
    console.error("Gagal menarik data teori:", error);
  } finally {
    isLoading.value = false;
  }
};

// Jalankan pengambilan data saat halaman pertama kali dimuat
onMounted(() => {
  fetchTheories();
});

// Fungsi untuk membuka detail modul
const openTheory = (theory) => {
  selectedTheory.value = theory;
  window.scrollTo({ top: 0, behavior: 'smooth' });
};

// Fungsi untuk menutup detail modul
const closeTheory = () => {
  selectedTheory.value = null;
  window.scrollTo({ top: 0, behavior: 'smooth' });
};
</script>

<style scoped>
.dashboard-wrapper {
  min-height: 100vh;
  padding: 40px 20px;
  display: flex;
  justify-content: center;
  align-items: flex-start;
}

.glass-container {
  background: rgba(0, 0, 0, 0.65);
  backdrop-filter: blur(20px) saturate(150%);
  -webkit-backdrop-filter: blur(20px) saturate(150%);
  border-radius: 24px;
  border: 1px solid rgba(226, 199, 146, 0.2);
  padding: 40px;
  max-width: 1000px;
  width: 100%;
  box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
  color: #fff;
}

.header-section {
  text-align: center;
  margin-bottom: 40px;
}

.header-section h2 {
  color: #E2C792;
  font-size: 32px;
  margin-bottom: 10px;
  font-weight: bold;
}

.header-section p {
  color: #aaa;
  font-size: 16px;
}

/* Loading State */
.loading-state, .empty-state {
  text-align: center;
  padding: 50px 0;
  color: #E2C792;
}

.spinner {
  font-size: 40px;
  display: inline-block;
  animation: bounce 1s infinite alternate;
}

@keyframes bounce {
  from { transform: translateY(0); }
  to { transform: translateY(-15px); }
}

/* Grid System untuk Kartu Modul */
.theory-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 30px;
}

.theory-card {
  background: rgba(255, 255, 255, 0.03);
  border: 1px solid rgba(226, 199, 146, 0.15);
  border-radius: 16px;
  overflow: hidden;
  transition: transform 0.3s, box-shadow 0.3s;
  display: flex;
  flex-direction: column;
}

.theory-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 25px rgba(226, 199, 146, 0.1);
  border-color: rgba(226, 199, 146, 0.4);
}

.card-image {
  height: 180px;
  overflow: hidden;
}

.card-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.5s;
}

.theory-card:hover .card-image img {
  transform: scale(1.05);
}

.card-content {
  padding: 25px;
  display: flex;
  flex-direction: column;
  flex-grow: 1;
}

.badge {
  background: rgba(226, 199, 146, 0.1);
  color: #E2C792;
  font-size: 12px;
  padding: 4px 10px;
  border-radius: 6px;
  align-self: flex-start;
  margin-bottom: 10px;
  font-weight: bold;
}

.card-content h3 {
  font-size: 20px;
  margin-bottom: 10px;
  color: #E2C792;
  line-height: 1.3;
}

.card-content p {
  color: #bbb;
  font-size: 14px;
  line-height: 1.6;
  margin-bottom: 20px;
  flex-grow: 1;
}

.btn-read {
  background: transparent;
  color: #E2C792;
  border: 1px solid #E2C792;
  padding: 10px;
  border-radius: 8px;
  cursor: pointer;
  font-weight: bold;
  transition: 0.3s;
  text-align: center;
}

.btn-read:hover {
  background: #E2C792;
  color: #000;
}

/* Detail View Styling */
.btn-back {
  background: transparent;
  border: none;
  color: #E2C792;
  cursor: pointer;
  font-size: 16px;
  font-weight: bold;
  margin-bottom: 30px;
  display: inline-flex;
  align-items: center;
}

.btn-back:hover {
  text-decoration: underline;
}

.theory-header {
  border-bottom: 1px solid rgba(226, 199, 146, 0.2);
  padding-bottom: 20px;
  margin-bottom: 30px;
}

.theory-header h1 {
  color: #E2C792;
  font-size: 36px;
  margin-bottom: 10px;
  line-height: 1.2;
}

.theory-meta {
  color: #888;
  font-size: 14px;
}

/* Styling untuk teks HTML dari Backend */
.theory-body {
  font-size: 16px;
  line-height: 1.8;
  color: #ddd;
  margin-bottom: 40px;
}

:deep(.html-content p) { margin-bottom: 20px; }
:deep(.html-content h2), :deep(.html-content h3) { color: #E2C792; margin: 30px 0 15px; }
:deep(.html-content ul) { margin-bottom: 20px; padding-left: 20px; }
:deep(.html-content li) { margin-bottom: 10px; }
:deep(.html-content strong) { color: #fff; font-weight: bold; }

.theory-footer {
  text-align: center;
  border-top: 1px solid rgba(226, 199, 146, 0.2);
  padding-top: 30px;
}

.btn-finish {
  background: #E2C792;
  color: #000;
  border: none;
  padding: 12px 30px;
  border-radius: 8px;
  font-weight: bold;
  font-size: 16px;
  cursor: pointer;
  transition: 0.3s;
}

.btn-finish:hover {
  background: #fff;
}
</style>