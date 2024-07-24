<template>
  <header class="bg-light shadow sticky top-0 z-50">
    <div class="container-fluid px-4 py-2 d-flex justify-content-between align-items-center ">
      <!-- Logo -->
      <div class="ml-5">
        <a href="/">
          <img src="../Images/salon.png" alt="" width="auto" height="60">
        </a>
      </div>

      <!-- Sign In -->
      <div class="navbar-nav d-flex justify-content-end" v-if="userAuth.isAuthenticated">
        <div class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
            <img v-if="userAuth.user.profile" class="rounded-circle me-lg-2 object-cover" :src="URL + userAuth.user.profile" alt=""
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
          <router-link to="/login"
            class="nav-link bg-pink-500 hover:bg-pink-500 text-white px-4 py-2 rounded transition-colors duration-300"><b>Login</b></router-link>
        </div>
      </div>
    </div>
  </header>
</template>

<script setup lang="ts">
import axiosInstance from '@/plugins/axios'
import URL from '@/api/url';
import { useAuthStore } from '@/stores/auth-store'
import Swal from 'sweetalert2'
const userAuth = useAuthStore()

const logout = async () => {
  try {
    const response = await axiosInstance.post('/logout');
    console.log(response.data.message);
    localStorage.removeItem('token');
    await Swal.fire({
      position: 'top-center',
      icon: 'success',
      title: 'You have been logged out!',
      showConfirmButton: false,
      timer: 1500,
    });
    window.location.replace('/');
  } catch (error) {
    console.error('Error logging out:', error);
    localStorage.removeItem('token');
  }
};

</script>
<style>
.btn-pink:hover {
  background-color: #ff20a6;
  color: aliceblue;
  border-radius: 5px;
}
</style>