<script setup lang="ts">
  import { ref } from 'vue';
  import 'bootstrap/dist/css/bootstrap.css';
  import 'bootstrap/dist/js/bootstrap.bundle.js';
  const imageShow = ref([
    { id: 2, image: "https://cdn.wynnresorts.com/q_auto,f_auto,w_1920/Wynn%20Las%20Vegas/Experiences/Salons/salon-at-wynn-v2-1920x602" },
    { id: 3, image: "https://cdn.wynnlasvegas.com/-/media/images/wynn-las-vegas/experiences/salons/909_claude_baruk_salon_wynn_interior_barbara_kraft.ashx?la=en&w=1920&hash=D4173509493128F2892769D89D049EB4" },
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

    <!-- Register employee -->
    <ol class="carousel-indicators">
    </ol>
    <div class="card">
      <h2 class="bg-white pl-5 m-5">We have many places to serve your transaction in use.</h2>
      <img class="w-100" src="https://niobebeauty.wordpress.com/wp-content/uploads/2019/07/slide35.jpg" alt="Image">
      <div class="card-img-overlay">
        <div class="pl-10 cardRegister mt-87">
          <div class="card w-50 bg-light">
            <div class="card-body">
              <h3 class="card-title">Register your shop here!!</h3>
              <p class="card-text">Do you want many new customers to enjoy booking for your convenience? We want it too!</p>
              <p class="card-text">How easy it is for us to include booking and online time to help you process your booking and not have to wait as fast as before!</p>
              <button type="button" class="btn btn-outline-danger"><router-link to="/register" class="nav-link">Register now</router-link></button>
            </div>
          </div>      
        </div>
      </div>
    </div>
  </div>
</template>