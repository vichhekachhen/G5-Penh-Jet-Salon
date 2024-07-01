<<<<<<< HEAD
<!-- <template>
  <v-card>
    <v-layout>
      <v-navigation-drawer v-model="drawer" :rail="rail" permanent @click="rail = false">
        <v-list-item prepend-avatar="https://randomuser.me/api/portraits/men/85.jpg" title="John Leider" nav>
          <template v-slot:append>
            <v-btn icon="mdi-chevron-left" variant="text" @click.stop="rail = !rail"></v-btn>
          </template>
        </v-list-item>
=======
<template>
  <transition name="fade" mode="out-in">
    <div class="sidebar bg-white border-right shadow-lg">
      <div class="user-profile d-flex align-items-center p-3 border-bottom">
        <img
          src="https://www.imgacademy.com/sites/default/files/styles/scale_1700w/public/2022-07/img-homepage-meta_0.jpg?itok=LMirU0Ik"
          alt="User Avatar" class="rounded-circle me-3" width="50" height="50">
        <div>
          <h5 class="text-muted fw-bold">Socheathek MAO</h5>
          <small class="text-muted fw-bold">Salon Owner</small>
        </div>
      </div>
      <hr>
      <nav class="nav flex-column">
        <router-link class="nav-link" :to="{ path: '/Dashboard' }" active-class="router-link-active">
          <i class="bi bi-calendar-event me-2"></i>
          Dashboard
        </router-link>
        <router-link class="nav-link" :to="{ path: '/Calendar' }" active-class="router-link-active">
          <i class="bi bi-calendar-event me-2"></i>
          Calendar
        </router-link>
        <router-link class="nav-link" :to="{ path: '/Messages' }" active-class="router-link-active">
          <i class="bi bi-envelope me-2"></i>
          Messages
        </router-link>
        <router-link class="nav-link" :to="{ path: '/ServiceOwner' }" active-class="router-link-active">
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
  </transition>
</template>
>>>>>>> 03f0e02fad0a1881090c93dc7acb1f1b560fe485

        <v-divider></v-divider>

        <v-list density="compact" nav>
          <v-list-item prepend-icon="mdi-home-city" title="Dashboard" value="Dashboard"></v-list-item>
          <v-list-item prepend-icon="mdi-account" title="Calendar" value="Calendar"></v-list-item>
          <v-list-item prepend-icon="mdi-account-group-outline" title="Messages" value="Messages"></v-list-item>
          <v-list-item prepend-icon="mdi-account-group-outline" title="Add Products & Service"
            value="Add Products & Service"></v-list-item>
          <v-list-item prepend-icon="mdi-account-group-outline" title="Orders" value="Orders"></v-list-item>
          <v-list-item prepend-icon="mdi-account-group-outline" title="Customers" value="Customers"></v-list-item>
          <v-list-item prepend-icon="mdi-account-group-outline" title="Settings" value="Settings"></v-list-item>
        </v-list>
      </v-navigation-drawer>
    </v-layout>
  </v-card>
</template>
<script>
export default {
  data() {
    return {
      drawer: true,
      rail: true,
    }
  },
}
</script>


<style scoped></style> -->
