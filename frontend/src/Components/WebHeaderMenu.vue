<template>
  <header class="bg-light shadow sticky top-0 z-50">
    <div class="container-fluid px-4 py-2 d-flex justify-content-between align-items-center ">
      <!-- Logo -->
      <div class="ml-5">
        <router-link to="/" class="bg-white">
          <img style="width: auto; height: 60px" src="../Images/salon.png" alt="">
        </router-link>
      </div>

      <!-- Menu Items -->
      <nav class="navbar navbar-expand-lg navbar-light">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <router-link class="nav-link font-bold text-white rounded-lg hover:bg-slate-100 hover:text-slate-900"
                to="/post">Post</router-link>
            </li>
          </ul>
        </div>
      </nav>

      <!-- Sign In -->
      <div class="navbar-nav d-flex justify-content-end" v-if="userAuth.isAuthenticated">
        <div class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
            <img v-if="userAuth.user.profile" class="rounded-circle me-lg-2" :src="URL+userAuth.user.profile" alt=""
              style="width: 40px; height: 40px">
            <img v-else class="rounded-circle me-lg-2" src="../Images/user/user_none.jpg" alt=""
              style="width: 40px; height: 40px">
            <h6 class="d-none d-lg-inline-flex text-pink-500">{{ userAuth.user.name }}</h6>
          </a>
          <div class="dropdown-menu dropdown-menu-end">
            <a href="/profile" class="dropdown-item">Profile</a>
            <a href="/history" class="dropdown-item">History</a>
            <a @click="logout()" href="#" class="dropdown-item">Logout</a>
          </div>
        </div>
      </div>
      <div class="navbar-nav d-flex justify-content-end" v-else>
        <div class="d-flex justify-content-around">
          <router-link to="/login" class="nav-link bg-pink-500 hover:bg-pink-500 text-white px-4 py-2 rounded transition-colors duration-300"><b>Login</b></router-link>
        </div>
      </div>
    </div>
  </header>
</template>

<script setup lang="ts">
import { useRouter } from 'vue-router'
import axiosInstance from '@/plugins/axios'
import URL from '@/api/url';
import { useAuthStore } from '@/stores/auth-store'
const userAuth = useAuthStore()

const router = useRouter()


const logout = async () => {
  try {
    const response = await axiosInstance.post('/logout')
    console.log(response.data.message)
    localStorage.removeItem('token')
    window.alert('You have been logged out!');
    window.location.href = '/'; 
    router.push('/')
  } catch (error) {
    console.error('Error logging out:', error)
  }
}
</script>
<style>
.btn-pink:hover{
  background-color: #ff20a6;
  color: aliceblue;
  border-radius: 5px;
}
</style>