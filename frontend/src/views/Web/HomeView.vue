<script setup lang="ts">
import WebLayout from '@/Components/Layouts/WebLayout.vue'
</script>
<template>
  <WebLayout
    >
    <div class="d-flex justify-content-around pt-5 ">
      <div class="card text-white col-3 shadow-lg card-hover">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRwwfk8hhhRhNlgDOcAFxZ3GoVkFHEdJYEwBA&s">
        <div class="card-img-overlay">
          <h5 class="card-title">Card title</h5>
        </div>
      </div>
      <div class="card text-white col-3 shadow-lg card-hover">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRwwfk8hhhRhNlgDOcAFxZ3GoVkFHEdJYEwBA&s">
        <div class="card-img-overlay">
          <h5 class="card-title">Card title</h5>
        </div>
      </div>
      <div class="card text-white col-3 shadow-lg card-hover">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRwwfk8hhhRhNlgDOcAFxZ3GoVkFHEdJYEwBA&s">
        <div class="card-img-overlay">
          <h5 class="card-title">Card title</h5>
        </div>
      </div>
    </div>
    <div class="d-flex justify-content-around pt-5">
      <div class="card text-white col-3 shadow-lg card-hover">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRwwfk8hhhRhNlgDOcAFxZ3GoVkFHEdJYEwBA&s">
        <div class="card-img-overlay">
          <h5 class="card-title">Card title</h5>
        </div>
      </div>
      <div class="card text-white col-3 shadow-lg card-hover">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRwwfk8hhhRhNlgDOcAFxZ3GoVkFHEdJYEwBA&s">
        <div class="card-img-overlay">
          <h5 class="card-title">Card title</h5>
        </div>
      </div>
      <div class="card text-white col-3 shadow-lg card-hover">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRwwfk8hhhRhNlgDOcAFxZ3GoVkFHEdJYEwBA&s">
        <div class="card-img-overlay">
          <h5 class="card-title">Card title</h5>
        </div>
      </div>
    </div>
    <div class="h-50">Hello</div>
    {{Image}}
  </WebLayout>
</template>

<script lang="ts">
  export default {
    data() {
      return {
        Image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRwwfk8hhhRhNlgDOcAFxZ3GoVkFHEdJYEwBA&s'
      }
    },
  }
</script>

<style scoped>
.card-hover{
  border: 2px solid rgba(228, 159, 151, 0.774);
}
.card-hover:hover{
  transform: scale(1.04);
  /* box-shadow: 0 18px 28px rgba(253, 198, 198, 0.25), 0 10px 10px rgba(250, 195, 195, 0.22); */
  transition: all 0.3s ease-in-out;
  transition-duration: 0.3s;
  transition-timing-function: ease-in-out;
  transition-delay: 0s;
  transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
}
</style>