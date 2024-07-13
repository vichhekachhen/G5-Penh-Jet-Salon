<template>
  <div>
    <!-- Alert register -->
    <div v-if="!userAuth.isAuthenticated" class="alert alert-danger alert-dismissible fade show text-center" role="alert">
      <strong>Do you want to become a member of me?</strong> Please click the button to become my member!
      <a href="/register" class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded transition-colors duration-300">Register now</a>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <MapComponent></MapComponent>
    <WebLayout></WebLayout>
    <SlineShow></SlineShow>
    <CardImageComponentVue></CardImageComponentVue>
    <Footer></Footer>

    <!-- Scroll up/down icon -->
    <div
      v-show="scrollPosition > 200" class="fixed bottom-4 right-4 z-50">
      <button @click="scrollUp" class="bg-pink-500 hover:bg-pink-600 text-white p-2 shadow-lg transition-colors duration-300">
        <i class="bi bi-arrow-up"></i>
      </button>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted, onBeforeUnmount } from 'vue';
import WebLayout from '@/Components/Layouts/WebLayout.vue'
import SlineShow from '@/Components/UserPage/SlineShow/SlineShowComponent.vue'
import CardImageComponentVue from '@/Components/UserPage/ProvinceCard/CardImageComponents.vue'
import Footer from '@/Components/Footer/footerComponent.vue'
import { useAuthStore } from '@/stores/auth-store'
import MapComponent from '@/Components/map/MapCom.vue'

const userAuth = useAuthStore()

const scrollPosition = ref(0);

const scrollUp = () => {
  window.scrollTo({ top: 0, behavior: 'smooth' });
};

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