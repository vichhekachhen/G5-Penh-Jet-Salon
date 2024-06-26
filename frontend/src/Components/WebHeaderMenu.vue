<template>
  <header class="flex justify-between px-15 py-2 bg-light items-center fixed top-0 w-full z-50">
    <!-- Logo -->
    <div class="flex items-center space-x-2">
      <img class="w-15" src="../Images/logo.png" alt="">
    </div>

    <!-- Menu Items -->
    <nav class="navbar navbar-default flex justify-center">
      <router-link class="px-3 py-2 text-pink-500 nav-link" aria-current="page" to="/">Home</router-link>
      <router-link class="px-3 py-2 text-pink-500 nav-link" to="/post">Post</router-link>
    </nav>

    <!-- Sign In -->
    <div v-if="userAuth.isAuthenticated">
      <div class="nav-item dropdown">
        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
          <img class="rounded-circle me-lg-2 " src="../Images/photo1.jpg" alt=""
            style="width: 45px; height: 45px" />
          <h6 class="d-none d-lg-inline-flex">{{ userAuth.user.name }}</h6>
        </a>
        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
          <a href="/profile" class="dropdown-item">Profile</a>
          <a href="#" class="dropdown-item">Settings</a>
          <a @click="logout()" href="#" class="dropdown-item">Log Out</a>
        </div>
      </div>
    </div>
    <div v-else>
      <router-link @click.prevent="logout" to="/login" class="px-4 py-2 rounded font-semibold btn btn-danger">Login
        Now</router-link>
    </div>
  </header>
</template>
<script setup lang="ts">
// import { Icon } from '@iconify/vue'
import { useRouter } from 'vue-router'
import axiosInstance from '@/plugins/axios'
import { useAuthStore } from '@/stores/auth-store'
const userAuth = useAuthStore()

const router = useRouter()

const logout = async () => {
  try {
    const response = await axiosInstance.post('/logout')
    console.log(response.data.message)
    localStorage.removeItem('token')
    router.push('/')
  } catch (error) {
    console.error('Error logging out:', error)
  }
}
</script>