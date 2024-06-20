<script setup lang="ts">
  import { ref } from 'vue';
  import 'bootstrap/dist/css/bootstrap.css';
  import 'bootstrap/dist/js/bootstrap.bundle.js';

  const imageShow = ref([
    // { id: 1, image: "https://www.learndirect.com/image/size/sm-course/uploads/products/6a802f8cffd55923baa85c22aaf0eac4.jpg.webp" },
    { id: 2, image: "https://static.wixstatic.com/media/f2b8aa_20d0c5de3367410ba704c76f39559efd~mv2.jpg/v1/fill/w_496,h_193,al_c,lg_1,q_80,usm_2.00_1.00_0.00,enc_auto/f2b8aa_20d0c5de3367410ba704c76f39559efd~mv2.jpg" },
    { id: 3, image: "https://www.learndirect.com/image/size/lg-course/uploads/products/a7affb5f7e1a8fa0348040cdf33e2ec3.jpg.webp" },
  ]);
</script>

<template>
  <div id="carouselExampleIndicators" class="carousel slide " data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button 
        v-for="(image, index) in imageShow" 
        :key="image.id" 
        type="button" 
        :data-bs-target="'#carouselExampleIndicators'" 
        :data-bs-slide-to="index" 
        :class="{ active: index === 0 }" 
        :aria-label="'Slide ' + (index + 1)"
      ></button>
    </div>
    <div class="carousel-inner">
      <div 
        v-for="(image, index) in imageShow" 
        :key="image.id" 
        :class="['carousel-item', { active: index === 0 }]"
      >
        <img :src="image.image" class="d-block w-100" alt="">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</template>

<script lang="ts">
  export default {
  }
</script>