<script setup lang="ts">
import WebLayout from '@/Components/Layouts/WebLayout.vue'
import SlineShow from '@/Components/UserPage/SlineShow/SlineShowComponent.vue'
import CardImageComponentVue from '@/Components/UserPage/UserCard/CardImageComponents.vue'
import footerVue from '@/Components/Footer/footer.vue'

import {useAuthStore} from '@/stores/auth-store';
const userAuth = useAuthStore();

</script>
<template>
  <!-- Alert register -->
  <div v-if="!userAuth.isAuthenticated" class="alert alert-danger alert-dismissible fade show" role="alert">

    <strong>Do you want to become a member of me?</strong> Please click the button to become my member!
    <a href="/register" class="btn btn-outline-danger">Register now</a>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <WebLayout></WebLayout>
  <SlineShow></SlineShow>
  <CardImageComponentVue></CardImageComponentVue>
  <footerVue/>
</template>