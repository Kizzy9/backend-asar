import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../view/HomeView.vue'
import ClassesView from '../view/ClassesView.vue'
import LoginView from '../view/LoginPage.vue'
import ProfileView from '../view/profilepage.vue'
import RegistrationView from '../view/RegistrationView.vue'

import TourPackagesView from '../view/TourPackagesView.vue'
import AboutView from '../view/AboutView.vue'
import NotReadyView from '../view/NotReadyView.vue'


const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    { path: '/', name: 'home', component: HomeView },
    { path: '/about', name: 'about', component: AboutView },
    { path: '/belum-siap', name: 'belum-siap', component: NotReadyView },
    { path: '/classes', name: 'classes', component: ClassesView },
    { path: '/tour-packages', name: 'tour-packages', component: TourPackagesView },
    { path: '/login', name: 'login', component: LoginView, meta: { requiresGuest: true } },
    { path: '/register-class', name: 'registration', component: RegistrationView },
    { path: '/profile', name: 'profile', component: ProfileView, meta: { requiresAuth: true } }
  ]
})

// Navigation Guard
router.beforeEach((to, from, next) => {
  const isAuthenticated = !!localStorage.getItem('token');

  // Jika halaman butuh login (seperti profil/dashboard)
  if (to.matched.some(record => record.meta.requiresAuth)) {
    if (!isAuthenticated) {
      next('/login');
    } else {
      next();
    }
  } 
  // Jika halaman hanya untuk guest (seperti form login)
  else if (to.matched.some(record => record.meta.requiresGuest)) {
    if (isAuthenticated) {
      next('/profile');
    } else {
      next();
    }
  } 
  // Halaman lainnya (publik)
  else {
    next();
  }
});

export default router