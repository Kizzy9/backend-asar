<template>
  <div class="glass-card">
    <div class="header">
      <h2>Selamat Datang</h2>
      <p>Masuk untuk menjelajahi oase</p>
    </div>

    <form @submit.prevent="handleLogin" class="form-content">
      <div class="input-group">
        <label>Email</label>
        <div class="input-wrapper">
          <input 
            v-model="form.email" 
            type="email" 
            placeholder="contoh@gurun.com" 
            autocomplete="username"
            required 
          />
        </div>
      </div>

      <div class="input-group">
        <label>Kata Sandi</label>
        <div class="input-wrapper password-wrapper">
          <input 
            v-model="form.password" 
            :type="showPassword ? 'text' : 'password'" 
            placeholder="••••••••" 
            autocomplete="current-password"
            required 
          />
          <button 
            type="button" 
            class="toggle-password-btn" 
            @click="togglePasswordVisibility"
            aria-label="Tampilkan atau sembunyikan kata sandi"
          >
            <span v-if="showPassword">👁️</span>
            <span v-else>🙈</span>
          </button>
        </div>
      </div>

      <button 
        type="submit" 
        class="sahara-btn" 
        :disabled="isLoading"
      >
        {{ isLoading ? 'Memproses...' : 'Masuk' }}
      </button>
    </form>
    
    <p v-if="errorMessage" class="error-text">
      {{ errorMessage }}
    </p>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import api from '../axios';

const router = useRouter();

const form = ref({ 
  email: '', 
  password: '' 
});

const isLoading = ref(false);
const errorMessage = ref('');
const showPassword = ref(false); // Variabel untuk mengontrol visibilitas sandi

// Fungsi untuk toggle (ubah state) password
const togglePasswordVisibility = () => {
  showPassword.value = !showPassword.value;
};

const handleLogin = async () => {
  isLoading.value = true;
  errorMessage.value = '';

  try {
    const response = await api.post('/login', form.value);
    const token = response.data.token || response.data.access_token;
    
    if (token) {
      localStorage.setItem('token', token);
      await router.push('/profile');
    } else {
      throw new Error("Token tidak ditemukan dari server.");
    }
    
  } catch (error) {
    console.error("Error Login:", error);
    
    if (error.response && error.response.data && error.response.data.message) {
      errorMessage.value = error.response.data.message;
    } else {
      errorMessage.value = "Gagal masuk. Periksa kembali email dan kata sandi Anda.";
    }
  } finally {
    isLoading.value = false;
  }
};
</script>

<style scoped>
.glass-card {
  background: rgba(0, 0, 0, 0.6);
  backdrop-filter: blur(25px) saturate(150%);
  -webkit-backdrop-filter: blur(25px) saturate(150%);
  border-radius: 30px;
  padding: 50px 40px;
  box-shadow: 0 30px 60px rgba(0, 0, 0, 0.5);
  border: 1px solid rgba(226, 199, 146, 0.2);
  max-width: 400px;
  width: 100%;
}

.header { 
  text-align: center; 
  margin-bottom: 35px; 
}

.header h2 { 
  font-size: 30px; 
  font-weight: 700; 
  color: #E2C792; 
  margin-bottom: 8px; 
}

.header p { 
  font-size: 14px; 
  color: #ccc; 
  font-weight: 300; 
}

.input-group { 
  margin-bottom: 25px; 
}

.input-group label { 
  display: block; 
  font-size: 13px; 
  font-weight: 600; 
  margin-bottom: 10px; 
  color: #E2C792; 
}

.input-wrapper {
  position: relative; /* Ditambahkan agar tombol toggle bisa posisi absolut di dalamnya */
}

.input-wrapper input {
  width: 100%; 
  padding: 15px 20px; 
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 15px; 
  background: rgba(0, 0, 0, 0.2); 
  color: #fff;
  transition: 0.3s;
}

/* Penyesuaian khusus untuk input password agar teks tidak tertutup ikon */
.password-wrapper input {
  padding-right: 50px; 
}

.input-wrapper input:focus {
  outline: none;
  border-color: #E2C792;
}

/* Style untuk Tombol Toggle Password */
.toggle-password-btn {
  position: absolute;
  right: 15px;
  top: 50%;
  transform: translateY(-50%);
  background: transparent;
  border: none;
  font-size: 18px;
  cursor: pointer;
  opacity: 0.7;
  transition: opacity 0.3s;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 0;
}

.toggle-password-btn:hover {
  opacity: 1;
}

.sahara-btn {
  width: 100%; 
  padding: 16px; 
  background: #E2C792; 
  color: #000;
  border: none; 
  border-radius: 15px; 
  font-size: 16px; 
  font-weight: bold; 
  cursor: pointer;
  text-transform: uppercase; 
  transition: 0.3s;
}

.sahara-btn:hover:not(:disabled) { 
  background: #fff; 
}

.sahara-btn:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}

.error-text { 
  color: #ff6b6b; 
  text-align: center; 
  margin-top: 20px; 
  font-size: 14px; 
  font-weight: 500;
}
</style>