<script setup lang="ts">
import WebLayout from '@/Components/Layouts/WebLayout.vue'
import SlineShow from '@/Components/UserPage/SlineShow/SlineShowComponent.vue'
import CardImageComponentVue from '@/Components/UserPage/UserCard/CardImageComponents.vue'
import FormBooingComponentVue from '../../Components/FormBooking/FormBooingComponent.vue'
import ListServiceComponentVue from '../../Components/Service/ListServiceComponent.vue'




</script>
<template>
  <!-- Alert register -->
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Do you want to become a member of me?</strong> Please click the button to become my member!
    <button class="btn btn-outline-danger">Register now</button>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <WebLayout></WebLayout>
  <SlineShow></SlineShow>
  <CardImageComponentVue></CardImageComponentVue>
  <ListServiceComponentVue></ListServiceComponentVue>
  <!-- <FormBooingComponentVue></FormBooingComponentVue> -->
</template>