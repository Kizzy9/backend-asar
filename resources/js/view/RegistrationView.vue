<template>
  <div class="registration-container">
    <div class="glass-card form-wrapper">
      <div class="header-form">
        <button class="btn-back" @click="$router.go(-1)">← Kembali</button>
        <h2>Formulir Pendaftaran</h2>
        <p>Lengkapi data diri Anda untuk bergabung bersama Asar Stable</p>
      </div>

      <div class="selected-package-badge" v-if="selectedPackage">
        Paket Dipilih: <strong>{{ selectedPackage }}</strong>
      </div>

      <form @submit.prevent="submitRegistration" class="registration-form">
        <div class="form-grid">
          <div class="input-group">
            <label>Nama Lengkap</label>
            <input 
              v-model="formData.nama" 
              type="text" 
              placeholder="Masukkan nama sesuai KTP" 
              required 
            />
          </div>

          <div class="input-group">
            <label>Umur</label>
            <input 
              v-model="formData.umur" 
              type="number" 
              placeholder="Contoh: 20" 
              required 
            />
          </div>

          <div class="input-group">
            <label>Tempat Lahir</label>
            <input 
              v-model="formData.tempat_lahir" 
              type="text" 
              placeholder="Contoh: Medan" 
              required 
            />
          </div>

          <div class="input-group">
            <label>Tanggal Lahir</label>
            <input 
              v-model="formData.tanggal_lahir" 
              type="date" 
              required 
            />
          </div>

          <div class="input-group">
            <label>Nomor WhatsApp</label>
            <input 
              v-model="formData.hp" 
              type="tel" 
              placeholder="0812xxxx" 
              required 
            />
          </div>

          <div class="input-group">
            <label>Alamat Email</label>
            <input 
              v-model="formData.email" 
              type="email" 
              placeholder="contoh@email.com" 
              required 
            />
          </div>

          <!-- Tambahan Input untuk Pembuatan Akun & Progress -->
          <div class="input-group">
            <label>Username (Nama Pengguna)</label>
            <input 
              v-model="formData.username" 
              type="text" 
              placeholder="Contoh: ahmad123 (Tanpa spasi)" 
              required 
            />
          </div>

          <div class="input-group">
            <label>Kata Sandi (Untuk Login)</label>
            <input 
              v-model="formData.password" 
              type="password" 
              placeholder="Minimal 6 karakter" 
              required 
              minlength="6"
            />
          </div>

          <div class="input-group">
            <label>Pilihan Coach</label>
            <select v-model="formData.coach" required>
              <option value="" disabled>Pilih Coach...</option>
              <option value="Coach Zaky">Coach Zaky</option>
              <option value="Coach Ari">Coach Ari</option>
            </select>
          </div>

          <div class="input-group full-width" style="grid-column: span 1;">
            <label>Tingkat Pengalaman</label>
            <select v-model="formData.pengalaman" required>
              <option value="" disabled>Pilih Level...</option>
              <option value="Pemula">Pemula (Belum pernah sama sekali)</option>
              <option value="Senior">Senior (Sudah terbiasa / Mahir)</option>
            </select>
          </div>
        </div>

        <div class="input-group full-width">
          <label>Alamat Domisili</label>
          <textarea 
            v-model="formData.alamat" 
            placeholder="Alamat lengkap saat ini..." 
            rows="3" 
            required
          ></textarea>
        </div>

        <div class="footer-form">
          <p class="terms">
            Dengan menekan tombol di bawah, Anda menyetujui aturan keselamatan di Asar Stable.
          </p>
          <button 
            type="submit" 
            class="btn-submit" 
            :disabled="isSubmitting"
          >
            {{ isSubmitting ? 'Mengirim...' : 'Konfirmasi Pendaftaran' }}
          </button>
        </div>
      </form>
    </div>

    <div class="modal-overlay" v-if="showSuccess">
      <div class="success-card">
        <div class="check-icon">✓</div>
        <h3>Pendaftaran Terkirim!</h3>
        <p>Terima kasih <strong>{{ formData.nama }}</strong>. Admin kami akan menghubungi Anda segera melalui WhatsApp.</p>
        <button @click="$router.push('/')">Kembali ke Beranda</button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import api from '../axios';

const route = useRoute();
const router = useRouter(); // Tambahkan useRouter agar bisa redirect ke beranda

const selectedPackage = ref('');
const isSubmitting = ref(false);
const showSuccess = ref(false);

const formData = ref({
  nama: '',
  umur: '',
  tempat_lahir: '',
  tanggal_lahir: '',
  hp: '',
  email: '',
  alamat: '',
  username: '',
  password: '',
  coach: '',
  pengalaman: ''
});

onMounted(() => {
  if (route.query.package) {
    selectedPackage.value = route.query.package;
  }
});

const submitRegistration = async () => {
  isSubmitting.value = true;
  
  try {
    // Memetakan data dari form Vue ke format yang sesuai dengan database Laravel
    const payload = {
      package_name: selectedPackage.value || 'Paket Umum',
      nama_lengkap: formData.value.nama,
      umur: formData.value.umur,
      tempat_lahir: formData.value.tempat_lahir,
      tanggal_lahir: formData.value.tanggal_lahir,
      email: formData.value.email,
      nomor_whatsapp: formData.value.hp,
      alamat_domisili: formData.value.alamat,
      username: formData.value.username,
      password: formData.value.password,
      coach: formData.value.coach,
      pengalaman: formData.value.pengalaman
    };

    // Mengirim data ke backend
    await api.post('/register-class', payload);
    
    // Jika berhasil (data masuk ke database), tampilkan modal
    showSuccess.value = true;

  } catch (error) {
    console.error("Error Detail:", error);
    
    // Penanganan Error yang lebih spesifik dari Laravel
    if (error.response && error.response.data) {
      const serverMessage = error.response.data.message;
      const validationErrors = error.response.data.errors;

      if (validationErrors) {
        // Menggabungkan pesan error validasi dari Laravel
        let errorMessages = '';
        for (const key in validationErrors) {
          errorMessages += `- ${validationErrors[key][0]}\n`;
        }
        alert(`Pendaftaran Gagal. Periksa kembali data Anda:\n\n${errorMessages}`);
      } else {
        // Error umum dari server (misal: 500 Server Error)
        alert(`Gagal: ${serverMessage || 'Terjadi kesalahan pada server.'}`);
      }
    } else {
      // Masalah jaringan atau CORS
      alert("Terjadi kesalahan jaringan. Pastikan server backend berjalan (php artisan serve).");
    }
  } finally {
    isSubmitting.value = false;
  }
};
</script>

<style scoped>
.registration-container {
  width: 100%;
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 40px 20px;
}

.form-wrapper {
  background: rgba(0, 0, 0, 0.8);
  backdrop-filter: blur(20px);
  border: 1px solid rgba(226, 199, 146, 0.4);
  border-radius: 30px;
  padding: 40px;
  max-width: 800px;
  width: 100%;
  box-shadow: 0 30px 60px rgba(0,0,0,0.8);
}

.header-form {
  text-align: center;
  margin-bottom: 30px;
  position: relative;
}

.btn-back {
  position: absolute;
  left: 0;
  top: 0;
  background: transparent;
  border: none;
  color: #E2C792;
  cursor: pointer;
  font-size: 14px;
}

h2 {
  color: #E2C792;
  font-size: 32px;
  text-transform: uppercase;
  letter-spacing: 2px;
  margin-bottom: 10px;
}

.header-form p {
  color: #aaa;
  font-size: 14px;
}

.selected-package-badge {
  background: rgba(226, 199, 146, 0.2);
  color: #E2C792;
  padding: 10px 20px;
  border-radius: 50px;
  display: inline-block;
  margin-bottom: 30px;
  border: 1px dashed #E2C792;
  font-size: 15px;
}

.form-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 20px;
}

.input-group {
  display: flex;
  flex-direction: column;
  margin-bottom: 15px;
  text-align: left;
}

.input-group label {
  color: #E2C792;
  font-size: 13px;
  font-weight: bold;
  margin-bottom: 8px;
  text-transform: uppercase;
}

.input-group input, 
.input-group textarea,
.input-group select {
  background: rgba(255, 255, 255, 0.05);
  border: 1px solid rgba(255, 255, 255, 0.2);
  border-radius: 10px;
  padding: 12px 15px;
  color: #fff;
  font-size: 15px;
  transition: 0.3s;
}

.input-group input:focus, 
.input-group textarea:focus,
.input-group select:focus {
  outline: none;
  border-color: #E2C792;
  background: rgba(255, 255, 255, 0.1);
}

.input-group select option {
  background: #1a1a1a;
  color: #fff;
}

.full-width { 
  grid-column: span 2; 
}

.footer-form {
  margin-top: 30px;
  text-align: center;
}

.terms {
  font-size: 12px;
  color: #777;
  margin-bottom: 20px;
}

.btn-submit {
  background: linear-gradient(45deg, #E2C792, #9E7E4F);
  color: #000;
  border: none;
  padding: 15px 50px;
  border-radius: 50px;
  font-size: 16px;
  font-weight: bold;
  cursor: pointer;
  transition: 0.3s;
}

.btn-submit:hover:not(:disabled) {
  transform: scale(1.05);
  box-shadow: 0 10px 20px rgba(226, 199, 146, 0.3);
}

.btn-submit:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}

/* Modal Style */
.modal-overlay {
  position: fixed;
  top: 0; 
  left: 0; 
  right: 0; 
  bottom: 0;
  background: rgba(0,0,0,0.9);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

.success-card {
  background: #1a1a1a;
  padding: 50px;
  border-radius: 30px;
  text-align: center;
  border: 2px solid #E2C792;
  max-width: 400px;
}

.check-icon {
  width: 70px;
  height: 70px;
  background: #E2C792;
  color: #000;
  font-size: 40px;
  line-height: 70px;
  border-radius: 50%;
  margin: 0 auto 20px;
}

.success-card h3 { 
  color: #E2C792; 
  font-size: 24px; 
  margin-bottom: 10px; 
}

.success-card p { 
  color: #ccc; 
  margin-bottom: 30px; 
}

.success-card button {
  background: #E2C792;
  border: none;
  padding: 10px 30px;
  border-radius: 10px;
  cursor: pointer;
  font-weight: bold;
  transition: 0.3s;
}

.success-card button:hover {
  background: #fff;
}

@media (max-width: 600px) {
  .form-grid { grid-template-columns: 1fr; }
  .full-width { grid-column: span 1; }
}
</style>