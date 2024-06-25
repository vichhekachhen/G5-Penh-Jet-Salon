<template>
  <header class="flex justify-between px-15 py-2 bg-light items-center">
    <!-- Logo -->
    <div class="flex items-center space-x-2">
      <img class="w-15" src="../views/Logo/Salon.png" alt=""> <b>SALON</b> 
    </div>

    <!-- Menu Items -->
    <nav class="navbar navbar-default flex justify-center space-x-4">
      <!-- ... (your existing menu items) -->
    </nav>

    <!-- Sign In -->
    <div v-if="userAuth.isAuthenticated">
      <div class="nav-item dropdown" ref="dropdownMenu">
        <a href="#" class="nav-link dropdown-toggle" @click.prevent="toggleDropdown">
          <img
            class="rounded-circle me-lg-2"
            :src="userAuth.user.avatarUrl"
            alt=""
            style="width: 40px; height: 40px"
          />
          <span class="d-none d-lg-inline-flex">{{ userAuth.user.name }}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0" :class="{ 'show': isDropdownOpen }">
          <router-link to="/profile" class="dropdown-item">Profile</router-link>
          <a href="#" class="dropdown-item">Settings</a>
          <a href="#" class="dropdown-item" @click.prevent="logout">Log Out</a>
        </div>
      </div>
    </div>
    <div v-else>
      <router-link
        @click.prevent="logout"
        to="/login"
        class="px-4 py-2 rounded font-semibold btn btn-danger"
        >Login Now</router-link
      >
    </div>
  </header>
</template>

<script setup lang="ts">
import { Icon } from '@iconify/vue'
import { useRouter } from 'vue-router'
import axiosInstance from '@/plugins/axios'
import { useAuthStore } from '@/stores/auth-store'
import { ref } from 'vue'

const userAuth = useAuthStore()
const router = useRouter()
const isDropdownOpen = ref(false)

const toggleDropdown = () => {
  isDropdownOpen.value = !isDropdownOpen.value
}

const logout = async () => {
  try {
    const response = await axiosInstance.post('/logout')
    console.log(response.data.message)
    localStorage.removeItem('token')
    router.push('/home')
  } catch (error) {
    console.error('Error logging out:', error)
  }
}

const handleClickOutside = (event: MouseEvent) => {
  if (isDropdownOpen.value && !event.target.closest('.nav-item.dropdown')) {
    isDropdownOpen.value = false
  }
}

document.addEventListener('click', handleClickOutside)
</script>