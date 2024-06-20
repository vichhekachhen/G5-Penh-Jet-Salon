<script setup lang="ts">
  import WebHeaderMenu from '@/Components/WebHeaderMenu.vue';
</script>

<template>
  <WebHeaderMenu />
  <div class="md:px-0 h-full header">
    <div class="h-full">
      <slot />
    </div>
  </div>
</template>
