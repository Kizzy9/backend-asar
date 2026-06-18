<template>
  <div class="container-classes">
    <div class="glass-card main-wrapper">
      <div class="header-section">
        <h2>Paket Wisata Berkuda</h2>
        <p class="subtitle">Nikmati pengalaman wisata berkuda yang tak terlupakan bersama kami.</p>
        
        <p v-if="isLoading" class="loading-text">Sedang memuat data terbaru dari server...</p>
      </div>

      <div class="class-grid">
        <div 
          v-for="item in tourPackages" 
          :key="item.id" 
          class="class-item"
        >
          <h3>{{ item.name }}</h3>
          
          <div class="price-box">
            <span class="main-price">Rp {{ item.price.toLocaleString('id-ID') }}</span>
          </div>
          
          <p class="desc">{{ item.description }}</p>
          <button class="btn-select" @click="contactAdmin(item.name)">Pesan Sekarang</button>
        </div>
      </div>

      <div class="footer-note" v-if="tourPackages.length === 0 && !isLoading">
        <p>Belum ada paket wisata yang tersedia saat ini.</p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import api from '../axios'; 

const isLoading = ref(false);
const tourPackages = ref([]);

const fetchTourPackages = async () => {
  try {
    isLoading.value = true;
    const response = await api.get('/tour-packages');
    
    if (response.data && response.data.data) {
      tourPackages.value = response.data.data;
    }
  } catch (error) {
    console.error("Gagal mengambil data paket wisata.", error);
    // Fallback data simulasi jika API belum diisi datanya
    tourPackages.value = [
      { id: 1, name: 'Wisata Hutan Pinus', price: 250000, description: 'Berkeliling area hutan pinus dengan kuda santai.' },
      { id: 2, name: 'Wisata Keluarga', price: 600000, description: 'Paket untuk 3 orang dengan pendampingan pelatih profesional.' }
    ];
  } finally {
    isLoading.value = false;
  }
};

onMounted(() => {
  fetchTourPackages();
});

const contactAdmin = (packageName) => {
  const message = `Halo Admin, saya tertarik untuk memesan Paket Wisata: ${packageName}`;
  window.open(`https://wa.me/6282364366595?text=${encodeURIComponent(message)}`, '_blank');
}
</script>

<style scoped>
.container-classes { width: 100%; display: flex; justify-content: center; padding: 20px; }
.main-wrapper { background: rgba(0, 0, 0, 0.75); backdrop-filter: blur(15px); border: 1px solid rgba(226, 199, 146, 0.3); border-radius: 30px; padding: 50px 40px; max-width: 1100px; width: 100%; box-shadow: 0 25px 50px rgba(0,0,0,0.5); }
.header-section { text-align: center; margin-bottom: 50px; }
h2 { color: #E2C792; font-size: 40px; text-transform: uppercase; letter-spacing: 4px; margin-bottom: 10px; text-shadow: 2px 2px 10px rgba(0,0,0,0.5); }
.subtitle { color: #ccc; font-size: 16px; }
.loading-text { color: #E2C792; font-size: 14px; margin-top: 15px; font-style: italic; animation: pulse 1.5s infinite; }
@keyframes pulse { 0% { opacity: 0.5; } 50% { opacity: 1; } 100% { opacity: 0.5; } }
.class-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 25px; }
.class-item { background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1); padding: 30px; border-radius: 20px; position: relative; transition: all 0.3s ease; display: flex; flex-direction: column; }
.class-item:hover { background: rgba(226, 199, 146, 0.1); transform: translateY(-10px); border-color: #E2C792; }
h3 { color: #fff; font-size: 22px; margin-bottom: 15px; }
.price-box { background: rgba(0, 0, 0, 0.3); padding: 15px; border-radius: 12px; margin-bottom: 15px; }
.main-price { display: block; font-size: 28px; font-weight: bold; color: #E2C792; }
.desc { font-size: 14px; line-height: 1.5; color: #ddd; margin-bottom: 20px; flex-grow: 1; }
.btn-select { width: 100%; padding: 12px; background: transparent; border: 1px solid #E2C792; color: #E2C792; border-radius: 10px; font-size: 14px; font-weight: bold; cursor: pointer; transition: all 0.3s ease; margin-top: auto; }
.btn-select:hover { background: #E2C792; color: #000; box-shadow: 0 5px 15px rgba(226, 199, 146, 0.3); }
.footer-note { margin-top: 50px; text-align: center; color: #888; font-style: italic; }
</style>
