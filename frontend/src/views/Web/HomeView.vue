<template>
  <div class="container-fluid p-0">
    <!-- Alert for non-authenticated users -->
    <div
      v-if="!userAuth.isAuthenticated"
      class="alert alert-danger alert-dismissible fade show text-center"
      role="alert"
    >
      <strong>Do you want to become a member of me?</strong> Please click the button to become my member!
      <a
        href="/register"
        class="btn btn-pink-500 text-white px-4 py-2 rounded transition-colors duration-300"
        >Register now</a
      >
      <button
        type="button"
        class="btn-close"
        data-bs-dismiss="alert"
        aria-label="Close"
      ></button>
    </div>

    <!-- Main Layout and Components -->
    <WebLayout />
    <SlineShow />
    <CardImageComponentVue />
    <Footer />

    <!-- Scroll up button -->
    <div
      v-show="scrollPosition > 200"
      class="position-fixed bottom-4 end-4 z-50"
    >
      <button
        @click="scrollUp"
        class="btn btn-pink-500 text-white p-2 shadow-lg transition-colors duration-300"
      >
        <i class="bi bi-arrow-up"></i>
      </button>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted, onBeforeUnmount } from 'vue';
import WebLayout from '@/Components/Layouts/WebLayout.vue';
import SlineShow from '@/Components/UserPage/SlineShow/SlineShowComponent.vue';
import CardImageComponentVue from '@/Components/UserPage/ProvinceCard/CardImageComponents.vue';
import Footer from '@/Components/Footer/footerComponent.vue';
import { useAuthStore } from '@/stores/auth-store';

const userAuth = useAuthStore();
const scrollPosition = ref(0);

// Function to scroll to the top of the page
const scrollUp = () => {
  window.scrollTo({ top: 0, behavior: 'smooth' });
};

// Function to handle scroll events
const handleScroll = () => {
  scrollPosition.value = window.pageYOffset || document.documentElement.scrollTop;
};

onMounted(() => {
  window.addEventListener('scroll', handleScroll);
});

onBeforeUnmount(() => {
  window.removeEventListener('scroll', handleScroll);
});
</script>

<style scoped>
/* Add Bootstrap 5 utility classes for custom colors */
.btn-pink-500 {
  background-color: #ec4899;
}
.btn-pink-500:hover {
  background-color: #db2777;
}

/* Adjust the button style for smooth transition */
.btn {
  transition: background-color 0.3s ease;
}

/* Prevent horizontal scrolling */
html, body {
  overflow-x: hidden;
}

/* Ensure all elements fit within the viewport */
.container-fluid {
  max-width: 100%;
}
</style>
