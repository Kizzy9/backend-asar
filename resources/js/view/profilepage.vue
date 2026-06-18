<template>
  <div class="dashboard-container">
    
    <div v-if="!selectedArticle">
      
      <!-- HEADER DASHBOARD -->
      <div class="profile-header glass-card">
        <div class="user-info">
          <h2>Selamat Datang, Penunggang!</h2>
          <p class="member-badge">✨ Status: Member Aktif (Premium)</p>
          <p class="subtitle">Pusat kendali perjalanan berkuda Anda di Ashabul Husna Ranch.</p>
        </div>
        <button @click="handleLogout" class="logout-btn">Keluar</button>
      </div>

      <div class="dashboard-grid">
        
        <!-- SIDEBAR / KOLOM KIRI (FITUR BARU) -->
        <div class="sidebar-column">
          
          <div v-if="isLoadingProgress" class="loading-text">
            Memuat Data Anda... ⏳
          </div>

          <template v-else-if="userProgress">
            <!-- WIDGET 1: Progress Tracker -->
            <div class="glass-card widget-card">
              <h3 class="widget-title">📈 Progress Belajar</h3>
              <div class="progress-info">
                <p class="level-text">Level Saat Ini: <strong>{{ userProgress.current_level }}</strong></p>
                <div class="progress-bar-bg">
                  <div class="progress-bar-fill" :style="{ width: userProgress.progress_percent + '%' }"></div>
                </div>
                <p class="progress-detail">{{ userProgress.progress_percent }}% Penguasaan Materi Dasar</p>
              </div>
              <ul class="skill-checklist">
                <li v-for="(skill, index) in userProgress.skills" :key="index" :class="skill.status">
                  <span v-if="skill.status === 'checked'">✅</span>
                  <span v-else-if="skill.status === 'active'">🔄</span>
                  <span v-else>🔒</span>
                  {{ skill.name }}
                </li>
              </ul>
            </div>

            <!-- WIDGET 2: Jadwal Terdekat -->
            <div class="glass-card widget-card schedule-card">
              <h3 class="widget-title">🗓️ Jadwal Latihan Terdekat</h3>
              <div v-if="userProgress.next_schedule_date" class="schedule-box">
                <div class="date-box">
                  <span class="day">{{ getDayName(userProgress.next_schedule_date) }}</span>
                  <span class="date">{{ getDateNum(userProgress.next_schedule_date) }}</span>
                  <span class="month">{{ getMonthName(userProgress.next_schedule_date) }}</span>
                </div>
                <div class="schedule-details">
                  <h4>Sesi {{ userProgress.current_level }}</h4>
                  <p>🕒 {{ userProgress.next_schedule_time }} WIB</p>
                  <p>👤 Instruktur: {{ userProgress.coach_name }}</p>
                </div>
              </div>
              <div v-else style="margin-bottom: 15px; color: #aaa; font-size: 14px;">
                Belum ada jadwal terdekat.
              </div>
              <button @click="openRescheduleModal" class="btn-reschedule">Ajukan Reschedule</button>
            </div>

            <!-- WIDGET 3: Catatan Instruktur -->
            <div class="glass-card widget-card note-card" v-if="userProgress.instructor_note">
              <h3 class="widget-title">📝 Catatan Instruktur</h3>
              <div class="note-content">
                <p><em>"{{ userProgress.instructor_note }}"</em></p>
                <span class="note-date">- {{ userProgress.coach_name }}, {{ formatDateSimple(userProgress.note_date) }}</span>
              </div>
            </div>
          </template>
        </div>

        <!-- MAIN COLUMN / KOLOM KANAN (ARTIKEL/MATERI EKSISTING) -->
        <div class="main-column">
          <div class="article-list-section glass-card">
            <div class="section-header">
              <h3 class="section-title">📚 Materi & Teori Eksklusif</h3>
              <p style="color: #aaa; margin-bottom: 20px; font-size: 14px;">Pelajari materi ini sebelum sesi latihan Anda untuk hasil maksimal.</p>
            </div>
            <hr class="divider" />

            <div v-if="isLoading" class="loading-text">
              <p>Memuat jurnal dari Asar Stable... ⏳</p>
            </div>

            <div v-else class="article-list">
              <div 
                v-for="theory in theories" 
                :key="theory.id" 
                class="article-item"
              >
                <div class="article-content">
                  <span class="read-more-tag" @click="openArticle(theory)">Read More..</span>
                  <h4 @click="openArticle(theory)" class="article-title">{{ theory.title }}</h4>
                  <p class="article-date">{{ theory.date }}</p>
                  <p class="article-excerpt">{{ theory.excerpt }}</p>
                </div>
                
                <div class="article-thumbnail" @click="openArticle(theory)">
                  <img :src="theory.image_url" :alt="theory.title" loading="lazy" />
                </div>
              </div>
              
              <!-- Tampilkan pesan jika artikel kosong (backend belum jalan) -->
              <div v-if="theories.length === 0" style="text-align: center; color: #888; padding: 20px;">
                <p>Belum ada materi teori yang diunggah.</p>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

    <!-- TAMPILAN FULL ARTIKEL (EKSISTING) -->
    <div v-else class="full-article-view glass-card">
      <button @click="closeArticle" class="btn-back">← Kembali ke Dashboard</button>
      
      <div class="article-hero-image">
        <img :src="selectedArticle.image_url" :alt="selectedArticle.title" />
      </div>

      <div class="full-article-content">
        <h1>{{ selectedArticle.title }}</h1>
        <p class="article-date-full">Diterbitkan pada: {{ selectedArticle.date }}</p>
        <hr class="divider" />
        
        <div class="html-content" v-html="selectedArticle.content"></div>
      </div>
    </div>

  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import api from '../axios';

const router = useRouter();

// State for Articles
const theories = ref([]);
const isLoading = ref(true);
const selectedArticle = ref(null);

// State for Progress Tracker
const userProgress = ref(null);
const isLoadingProgress = ref(true);

// Mengambil data teori dari backend
const fetchTheories = async () => {
  try {
    isLoading.value = true;
    const response = await api.get('/equestrian-theories');
    if (response.data && response.data.success) {
      theories.value = response.data.data;
    }
  } catch (error) {
    console.error("Gagal memuat materi teori:", error);
  } finally {
    isLoading.value = false;
  }
};

// Mengambil data progress dari backend
const fetchProgress = async () => {
  try {
    isLoadingProgress.value = true;
    const response = await api.get('/user-progress');
    if (response.data && response.data.success) {
      userProgress.value = response.data.data;
    }
  } catch (error) {
    console.error("Gagal memuat data progress:", error);
  } finally {
    isLoadingProgress.value = false;
  }
};

onMounted(() => {
  fetchTheories();
  fetchProgress();
});

const openArticle = (article) => {
  selectedArticle.value = article;
  window.scrollTo({ top: 0, behavior: 'smooth' });
};

const closeArticle = () => {
  selectedArticle.value = null;
};

const handleLogout = async () => {
  try {
    localStorage.removeItem('token');
    router.push('/login');
  } catch (error) {
    console.error("Gagal keluar:", error);
  }
};

// Logika Format Tanggal
const getDayName = (dateStr) => {
  const date = new Date(dateStr);
  return date.toLocaleDateString('id-ID', { weekday: 'long' });
};
const getDateNum = (dateStr) => {
  const date = new Date(dateStr);
  return date.getDate();
};
const getMonthName = (dateStr) => {
  const date = new Date(dateStr);
  return date.toLocaleDateString('id-ID', { month: 'short' });
};
const formatDateSimple = (dateStr) => {
  if (!dateStr) return '';
  const date = new Date(dateStr);
  return date.toLocaleDateString('id-ID', { day: 'numeric', month: 'long' });
};

// Logika Reschedule
const openRescheduleModal = async () => {
  const requestDate = prompt("Masukkan tanggal reschedule yang diinginkan (Contoh: 2026-06-25):");
  if (!requestDate) return;
  
  const reason = prompt("Apa alasan Anda mengajukan reschedule?");
  
  try {
    const payload = {
      requested_date: requestDate,
      reason: reason || ''
    };
    
    await api.post('/reschedule', payload);
    alert("Permintaan reschedule berhasil dikirim. Admin kami akan menghubungi Anda melalui WhatsApp.");
  } catch (error) {
    alert("Gagal mengajukan reschedule. Pastikan format tanggal benar (YYYY-MM-DD).");
  }
};
</script>

<style scoped>
/* TEMA BARU: Dark, Elegant, Gold Accents */

.dashboard-container {
  max-width: 1300px; /* Diperlebar untuk layout grid */
  margin: 0 auto;
  padding: 40px 20px;
  background-color: transparent;
  color: #cccccc;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  min-height: 100vh;
}

/* WADAH GLASS-CARD */
.glass-card {
  background: rgba(20, 20, 20, 0.6);
  backdrop-filter: blur(20px) saturate(150%);
  -webkit-backdrop-filter: blur(20px) saturate(150%);
  border-radius: 20px;
  border: 1px solid rgba(226, 199, 146, 0.2);
  box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
  padding: 40px;
  margin-bottom: 30px;
}

/* Header Profil */
.profile-header {
  display: flex;
  justify-content: space-between;
  align-items: flex-end;
  padding-bottom: 30px;
}

.user-info h2 {
  color: #E2C792;
  font-size: 32px;
  margin-bottom: 10px;
  font-weight: 700;
}

.member-badge {
  display: inline-block;
  background: rgba(226, 199, 146, 0.1);
  color: #E2C792;
  border: 1px solid #E2C792;
  padding: 6px 15px;
  border-radius: 4px;
  font-size: 14px;
  font-weight: 600;
  margin-bottom: 10px;
}

.subtitle {
  color: #cccccc;
  font-size: 16px;
}

.logout-btn {
  background: transparent;
  color: #E2C792;
  border: 1px solid #E2C792;
  padding: 10px 25px;
  border-radius: 8px;
  font-weight: bold;
  cursor: pointer;
  transition: all 0.3s ease;
}

.logout-btn:hover {
  background: #E2C792;
  color: #12100E;
}

/* DASHBOARD GRID LAYOUT */
.dashboard-grid {
  display: grid;
  grid-template-columns: 350px 1fr;
  gap: 30px;
}

/* WIDGETS (SIDEBAR) */
.widget-card {
  padding: 30px;
}

.widget-title {
  color: #E2C792;
  font-size: 18px;
  margin-bottom: 20px;
  border-bottom: 1px solid rgba(226, 199, 146, 0.2);
  padding-bottom: 10px;
}

/* Progress Tracker */
.progress-info {
  margin-bottom: 20px;
}

.level-text {
  color: #fff;
  font-size: 15px;
  margin-bottom: 10px;
}

.progress-bar-bg {
  width: 100%;
  height: 8px;
  background: rgba(255, 255, 255, 0.1);
  border-radius: 10px;
  overflow: hidden;
  margin-bottom: 8px;
}

.progress-bar-fill {
  height: 100%;
  background: linear-gradient(90deg, #9E7E4F, #E2C792);
  border-radius: 10px;
  transition: width 1s ease-in-out;
}

.progress-detail {
  font-size: 12px;
  color: #aaa;
}

.skill-checklist {
  list-style: none;
  padding: 0;
  font-size: 14px;
}

.skill-checklist li {
  margin-bottom: 10px;
  padding: 8px 10px;
  border-radius: 6px;
  background: rgba(255, 255, 255, 0.02);
}

.skill-checklist .checked { color: #888; text-decoration: line-through; }
.skill-checklist .active { color: #E2C792; border-left: 3px solid #E2C792; background: rgba(226, 199, 146, 0.05); }
.skill-checklist .locked { color: #555; }

/* Schedule Widget */
.schedule-box {
  display: flex;
  gap: 15px;
  align-items: center;
  background: rgba(0, 0, 0, 0.4);
  padding: 15px;
  border-radius: 10px;
  margin-bottom: 15px;
}

.date-box {
  background: rgba(226, 199, 146, 0.1);
  border: 1px solid #E2C792;
  border-radius: 8px;
  padding: 10px;
  text-align: center;
  min-width: 70px;
}

.date-box .day { display: block; font-size: 10px; color: #E2C792; text-transform: uppercase; }
.date-box .date { display: block; font-size: 24px; font-weight: bold; color: #fff; line-height: 1.1; }
.date-box .month { display: block; font-size: 12px; color: #E2C792; }

.schedule-details h4 { color: #fff; margin-bottom: 5px; font-size: 15px; }
.schedule-details p { font-size: 13px; color: #aaa; margin-bottom: 3px; }

.btn-reschedule {
  width: 100%;
  background: transparent;
  color: #aaa;
  border: 1px dashed rgba(255,255,255,0.2);
  padding: 10px;
  border-radius: 6px;
  cursor: pointer;
  transition: 0.3s;
}
.btn-reschedule:hover { color: #E2C792; border-color: #E2C792; }

/* Note Widget */
.note-content {
  background: rgba(226, 199, 146, 0.05);
  border-left: 3px solid #E2C792;
  padding: 15px;
  border-radius: 0 8px 8px 0;
}
.note-content p { font-size: 14px; color: #ddd; line-height: 1.6; margin-bottom: 10px; }
.note-date { font-size: 12px; color: #E2C792; font-weight: bold; }

/* Layout Daftar Artikel */
.section-title {
  font-size: 28px;
  color: #E2C792;
  margin-bottom: 5px;
  font-weight: 700;
}

.divider {
  border: 0;
  height: 1px;
  background: rgba(226, 199, 146, 0.3);
  margin-bottom: 40px;
}

.loading-text {
  text-align: center;
  color: #E2C792;
  padding: 40px;
  font-weight: bold;
}

.article-item {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  gap: 30px;
  padding-bottom: 40px;
  margin-bottom: 40px;
  border-bottom: 1px dashed rgba(255, 255, 255, 0.15);
}

.article-item:last-child {
  border-bottom: none;
  margin-bottom: 0;
  padding-bottom: 0;
}

.article-content {
  flex: 1;
}

.read-more-tag {
  display: inline-block;
  font-size: 14px;
  font-weight: bold;
  text-decoration: underline;
  color: #cccccc;
  margin-bottom: 10px;
  cursor: pointer;
  transition: color 0.2s;
}

.read-more-tag:hover {
  color: #E2C792;
}

.article-title {
  font-size: 24px;
  color: #E2C792;
  margin-bottom: 10px;
  cursor: pointer;
  font-weight: 700;
  transition: color 0.2s;
  line-height: 1.3;
}

.article-title:hover {
  color: #ffffff;
  text-decoration: underline;
}

.article-date {
  font-size: 12px;
  color: #888888;
  margin-bottom: 15px;
}

.article-excerpt {
  font-size: 15px;
  color: #cccccc;
  line-height: 1.6;
}

.article-thumbnail {
  flex-shrink: 0;
  width: 250px;
  height: 180px;
  overflow: hidden;
  cursor: pointer;
  border-radius: 8px;
}

.article-thumbnail img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.5s ease;
}

.article-thumbnail:hover img {
  transform: scale(1.05);
}

/* Tampilan Detail Artikel Lengkap */
.btn-back {
  background: transparent;
  color: #E2C792;
  border: 1px solid #E2C792;
  padding: 12px 24px;
  border-radius: 8px;
  cursor: pointer;
  font-weight: bold;
  margin-bottom: 30px;
  transition: background 0.3s;
}

.btn-back:hover {
  background: #E2C792;
  color: #12100E;
}

.article-hero-image {
  width: 100%;
  height: 400px;
  overflow: hidden;
  margin-bottom: 40px;
  border-radius: 12px;
}

.article-hero-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.full-article-content h1 {
  color: #E2C792;
  font-size: 42px;
  margin-bottom: 15px;
  font-weight: 800;
  line-height: 1.2;
}

.article-date-full {
  color: #888888;
  font-size: 15px;
  margin-bottom: 30px;
}

.html-content {
  font-size: 18px;
  line-height: 1.8;
  color: #cccccc;
}

:deep(.html-content p) { margin-bottom: 20px; }
:deep(.html-content ul) { padding-left: 25px; margin-bottom: 25px; }
:deep(.html-content li) { margin-bottom: 12px; }
:deep(.html-content strong) { color: #E2C792; }

/* Responsiveness untuk HP */
@media (max-width: 1024px) {
  .dashboard-grid { grid-template-columns: 1fr; }
  .article-item { flex-direction: column-reverse; gap: 20px; }
  .article-thumbnail { width: 100%; height: 200px; }
  .profile-header { flex-direction: column; align-items: flex-start; gap: 20px; }
  .article-hero-image { height: 300px; }
}
</style>