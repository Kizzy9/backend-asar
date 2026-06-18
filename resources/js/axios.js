import axios from 'axios';

// 1. Inisialisasi Instance Axios
const api = axios.create({
  baseURL: '/api',
  headers: {
    'Accept': 'application/json',
    'Content-Type': 'application/json',
  },
});

// 2. Interceptor Request: Otomatis menyisipkan token ke setiap request
api.interceptors.request.use(
  (config) => {
    const token = localStorage.getItem('token');
    if (token) {
      config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
  },
  (error) => {
    return Promise.reject(error);
  }
);

// 3. Interceptor Response: Menangani error global (seperti sesi kedaluwarsa)
api.interceptors.response.use(
  (response) => {
    return response;
  },
  (error) => {
    // Jika backend mengirim status 401 (Unauthorized)
    if (error.response && error.response.status === 401) {
      console.warn('Sesi tidak valid. Membersihkan data sesi...');
      
      // Hapus token yang bermasalah
      localStorage.removeItem('token');
      
      // Redirect ke login (menggunakan window.location untuk reload fresh)
      if (window.location.pathname !== '/login') {
        window.location.href = '/login';
      }
    }
    
    // Memberikan akses error ke blok catch() di komponen
    return Promise.reject(error);
  }
);

export default api;