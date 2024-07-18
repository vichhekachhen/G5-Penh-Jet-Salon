<template>
  <div>
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button
          v-for="(image, index) in slide.slides"
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
          v-for="(image, index) in slide.slides"
          :key="image.id"
          :class="['carousel-item', { active: index === 0 }]"
        >
          <img :src="baseURL + image.image" class="d-block w-100 h-90" alt="..." />
        </div>
      </div>
      <button
        class="carousel-control-prev"
        type="button"
        data-bs-target="#carouselExampleIndicators"
        data-bs-slide="prev"
      >
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button
        class="carousel-control-next"
        type="button"
        data-bs-target="#carouselExampleIndicators"
        data-bs-slide="next"
      >
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

    <!-- Register employee -->
    <div class="card mt-4">
      <div class="text-center p-4">
        <h5 class="font-weight-bold text-muted">Experience Life the Salon Way</h5>
        <p>
          Enjoy more of what you love. Let us pamper you with relaxing treatments, stylish cuts, and
          fresh new looks.
        </p>
      </div>

      <img
        class="w-100"
        style="height: 30rem; object-fit: cover"
        src="../../../Images/shop1.jpg"
        alt="Image"
      />
    </div>
  </div>
</template>

<script>
import 'bootstrap/dist/js/bootstrap.bundle.js'
import { useSlideStore } from '@/stores/slide'
import axiosInstance from '@/api/api'

export default {
  data() {
    return {
      slide: useSlideStore(),
      baseURL: ''
    }
  },
  methods: {
    async getSlide() {
      this.slide.getAllSlide()
    },
    getBaseURL() {
      const url = axiosInstance.defaults.baseURL
      return url.endsWith('/api') ? url.slice(0, -4) : url
    }
  },
  mounted() {
    this.baseURL = this.getBaseURL()
    this.getSlide()
  }
}
</script>

<style>
.custom-margin {
  margin-top: 450px; /* Adjust this value as needed */
}
.carousel-inner img {
  object-fit: cover;
}

@media (max-width: 768px) {
  .card-img-overlay {
    padding: 10px;
  }

  .card-img-overlay .card {
    width: 100%;
  }
}

@media (min-width: 769px) {
  .card-img-overlay .card {
    width: 50%;
  }
}
</style>
