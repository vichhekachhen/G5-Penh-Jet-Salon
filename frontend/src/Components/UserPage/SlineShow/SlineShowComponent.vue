<script setup lang="ts">
  import { ref } from 'vue';
  import 'bootstrap/dist/css/bootstrap.css';
  import 'bootstrap/dist/js/bootstrap.bundle.js';
  const imageShow = ref([
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
    <div class="card">
        <h2 class="bg-white pl-5 m-5">We have many places to serve your transaction in use.</h2>
        <img class="w-100" src="https://www.learndirect.com/image/size/lg-course/uploads/products/a7affb5f7e1a8fa0348040cdf33e2ec3.jpg.webp" alt="Image">
        <div class="card-img-overlay">
          <div class="pl-10 cardRegister mt-115">
            <div class="card w-50 bg-light">
              <div class="card-body">
                <h3 class="card-title">Register your restaurant and shop</h3>
                <p class="card-text">Salon in the Cambodia</p>
                <p class="card-text">Do you want many new customers to enjoy booking for your convenience? We want it too!</p>
                <p class="card-text">How easy it is for us to include booking and online time to help you process your booking and not have to wait as fast as before!</p>
                <!-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> -->
                <button type="button" class="btn btn-outline-danger"><router-link to="/login" class="nav-link">Login now</router-link></button>
              </div>
            </div>      
          </div>
        </div>
    </div>
</template>

<script lang="ts">
  export default {
  }
</script>