<template>
  <div id="app-container">
    <nav class="glass-nav">
      <div class="logo">🐎 Asar Stable</div>
      <div class="nav-links">
        <router-link to="/">Beranda</router-link>
        <router-link to="/about">Tentang Kami</router-link>
        <router-link to="/classes">Program Kelas</router-link>
        <router-link v-if="!isLoggedIn" to="/login">Login</router-link>
        <router-link v-else to="/profile">Dashboard</router-link>
      </div>
    </nav>

    <main class="content-area">
      <router-view v-slot="{ Component, route }">
        <transition name="fade-slide" mode="out-in">
          <component :is="Component" :key="route.path" />
        </transition>
      </router-view>
    </main>

    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/6282364366595?text=Halo%20Admin%20ASAR,%20saya%20ingin%20bertanya%20tentang%20kelas%20berkuda." 
       target="_blank" 
       class="floating-wa"
       aria-label="Chat WhatsApp">
      <svg viewBox="0 0 32 32" width="32" height="32" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path d="M16.002 2C8.283 2 2.016 8.267 2.016 15.986c0 2.456.643 4.862 1.867 6.993L2 29.98l7.155-1.874a13.923 13.923 13.923 0 006.847 1.785c7.718 0 13.984-6.267 13.984-13.986C29.986 8.267 23.72 2 16.002 2zm7.986 20.08c-.332.936-1.92 1.786-2.67 1.916-.71.12-1.637.284-5.267-1.22-4.385-1.815-7.23-6.284-7.447-6.574-.216-.29-1.776-2.366-1.776-4.51 0-2.146 1.124-3.2 1.528-3.633.404-.433.876-.54 1.166-.54.29 0 .58.006.833.018.265.012.617-.1 1.002.825.405.975 1.385 3.38 1.503 3.626.117.246.195.534.05.823-.146.29-.22.47-.44.717-.217.247-.456.545-.657.733-.216.204-.44.425-.19.855.25.432 1.11 1.836 2.384 2.975 1.644 1.47 3.017 1.924 3.45 2.126.434.204.685.176.94-.12.253-.29 1.096-1.282 1.39-1.725.294-.443.587-.367.985-.216.398.15 2.51 1.183 2.94 1.4.434.216.723.324.827.504.106.18.106 1.04-.226 1.976z"/>
      </svg>
    </a>
  </div>
</template>

<script setup>
import { ref, watchEffect } from 'vue';
import { useRoute } from 'vue-router';

const route = useRoute();
const isLoggedIn = ref(false);

watchEffect(() => {
  // Re-evaluate whenever route changes
  isLoggedIn.value = !!localStorage.getItem('token');
});
</script>

<style>
@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap');

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Montserrat', sans-serif;
}

html {
  scroll-behavior: smooth !important;
}

body {
  background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.8)), 
              url('/bg-asar.png') no-repeat center center fixed !important;
  background-size: cover !important;
  min-height: 100vh;
  color: #fff;
}

#app-container {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}

.glass-nav {
  background: rgba(0, 0, 0, 0.4); 
  backdrop-filter: blur(15px);
  -webkit-backdrop-filter: blur(15px);
  border-bottom: 1px solid rgba(255, 255, 255, 0.05);
  padding: 20px 50px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  position: sticky;
  top: 0;
  z-index: 100;
}

.logo {
  font-size: 26px;
  font-weight: 700;
  color: #E2C792;
  letter-spacing: 1px;
}

.nav-links a {
  color: #fff;
  text-decoration: none;
  margin-left: 35px;
  font-weight: 400;
  transition: color 0.3s ease;
}

.nav-links a:hover, .nav-links a.router-link-active {
  color: #E2C792;
}

.content-area {
  flex: 1;
  display: flex;
  justify-content: center; /* Memastikan semua isi ke tengah */
  align-items: center;    /* Memastikan semua isi ke tengah vertikal */
  padding: 20px;
}

.fade-slide-enter-active,
.fade-slide-leave-active {
  transition: opacity 0.5s ease-in-out, transform 0.5s ease-in-out !important;
}

.fade-slide-enter-from {
  opacity: 0 !important;
  transform: translateY(15px) !important;
}

.fade-slide-leave-to {
  opacity: 0 !important;
  transform: translateY(-15px) !important;
}

@media (max-width: 768px) {
  .glass-nav { padding: 15px 20px; }
  .logo { font-size: 20px; }
  .nav-links a { margin-left: 15px; font-size: 14px; }
}

/* Floating WA Button */
.floating-wa {
  position: fixed;
  bottom: 30px;
  right: 30px;
  background-color: #25D366;
  color: white;
  border-radius: 50%;
  width: 60px;
  height: 60px;
  display: flex;
  justify-content: center;
  align-items: center;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
  z-index: 1000;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.floating-wa:hover {
  transform: scale(1.1);
  box-shadow: 0 6px 14px rgba(0, 0, 0, 0.4);
}
</style>