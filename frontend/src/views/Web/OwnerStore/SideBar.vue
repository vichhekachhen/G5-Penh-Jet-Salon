<template>
  <div class="d-flex">
    <div class="sidebar bg-white border-right shadow-lg">
      <div class="user-profile d-flex align-items-center p-3 border-bottom">
        <img
          src="https://www.imgacademy.com/sites/default/files/styles/scale_1700w/public/2022-07/img-homepage-meta_0.jpg?itok=LMirU0Ik"
          alt="User Avatar" class="rounded-circle me-3" width="50" height="50">
        <div>
          <h5 class="text-muted fw-bold">Socheathek MAO</h5>
          <small class="text-muted fw-bold">Salon Owner</small>
          <!-- <span class="badge bg-success">Salon Owner</span> -->
        </div>
      </div>
      <hr>
      <nav class="nav flex-column">
        <router-link class="nav-link" :to="{ path: '/Dashboard' }" active-class="router-link-active">
          <i class="bi bi-calendar-event me-2"></i>
          Dashboard
        </router-link>
        <router-link class="nav-link" :to="{ path: '/Schedule' }" active-class="router-link-active">
          <i class="bi bi-calendar-event me-2"></i>
          Schedule
        </router-link>
        <router-link class="nav-link" :to="{ path: '/Messages' }" active-class="router-link-active">
          <i class="bi bi-envelope me-2"></i>
          Messages
        </router-link>
        <router-link class="nav-link" :to="{ path: '/AddProductService' }" active-class="router-link-active">
          <i class="bi bi-plus-circle me-2"></i>
          Add Product & Service
        </router-link>
        <router-link class="nav-link" :to="{ path: '/Orders' }" active-class="router-link-active">
          <i class="bi bi-cart-check me-2"></i>
          Orders
        </router-link>
        <router-link class="nav-link" :to="{ path: '/Analytics' }" active-class="router-link-active">
          <i class="bi bi-bar-chart-line me-2"></i>
          Analytics
        </router-link>
        <router-link class="nav-link" :to="{ path: '/Customers' }" active-class="router-link-active">
          <i class="bi bi-people me-2"></i>
          Customers
        </router-link>
        <router-link class="nav-link" :to="{ path: '/Settings' }" active-class="router-link-active">
          <i class="bi bi-gear me-2"></i>
          Settings
        </router-link>
      </nav>
    </div>
  </div>
</template>

<script>
export default {
  name: 'SideBar',
}
</script>

<style scoped>
.sidebar {
  background-color: #007bff;
  height: 100vh;
  position: fixed;
  left: 0;
  width: 250px;
  z-index: 10;
}

@media (max-width: 768px) {
  .sidebar {
    width: 100%;
    height: auto;
    position: relative;
  }
}

.nav-link {
  color: #495057;
  font-size: 16px;
  padding: 0.75rem 1.5rem;
  transition: background-color 0.2s ease-in-out;
}

.nav-link:hover {
  background-color: #f8f9fa;
  color: #007bff;
}

.router-link-active {
  background-color: #007bff !important;
  color: #ffffff !important;
  border-radius: 0.375rem;
  margin-left: 0.5rem;
  margin-right: 0.5rem;
}

.nav-link i {
  font-size: 18px;
}
</style>
