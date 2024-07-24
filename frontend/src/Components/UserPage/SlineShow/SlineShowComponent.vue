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
          <img :src="baseURL + image.image" class="d-block w-100 h-90" alt="" />
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
    <div class="card">
      <h2 class="text-show p-13 text-center font-weight-bold text-muted">
        We are here to help you live life the salon way.<br />Spend more time doing what you love.
        <br />We'll take care of relaxing treatments, stylish cuts, and new looks.
      </h2>
      <div class="contact">
        <img class="w-100" style="height: 30rem" src="../../../Images/shop1.jpg" alt="Image" />
        <div class="card-img-overlay">
          <div class="pl-10 cardRegister mt-100">
            <div class="card w-50 bg-light">
              <div class="card-body">
                <h3 class="text-pink-500">Join your shop here!</h3>
                <p class="card-text">
                  Expand your client base and streamline your booking process by becoming a Sala
                  Salon Partner.
                </p>
                <p class="card-text">
                  Our centralized online booking system and marketing support make it easy for
                  customers to discover and book appointments at your salon.
                </p>

                <form @submit.prevent="sentMail">
                  <label
                    for="email"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >Sent an email to be our partner !</label
                  >
                  <input
                    type="email"
                    id="email"
                    v-model="email"
                    aria-describedby="helper-text-explanation"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mt-2 mb-2"
                    placeholder="example@gmail.com"
                  />
                  <small
                    class="text-green-500 0 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mt-1 mb-1"
                    v-if="successMessage != ''"
                    >{{ successMessage }}</small
                  >
                  <small
                    v-else
                    class="text-red-500 0 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mt-1 mb-1"
                    >{{ errorMessage }}</small
                  >
                  <button
                    type="submit"
                    class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded transition-colors duration-300"
                  >
                    Contact now
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import 'bootstrap/dist/js/bootstrap.bundle.js'
import { useSlideStore } from '@/stores/slide'
import { useMailStore } from '@/stores/mail'
const slide = useSlideStore()
import axiosInstance from '@/api/api'
const base = axiosInstance
const mail = useMailStore()

export default {
  data() {
    return {
      slide: useSlideStore(),
      baseURL: '',
      email: '',
      successMessage: '',
      errorMessage: ''
    }
  },
  methods: {
    async getSlide() {
      slide.getAllSlide()
    },
    getBaseURL() {
      const url = base.defaults.baseURL
      return url.endsWith('/api') ? url.slice(0, -4) : url
    },

    sentMail() {
      const data = {
        email: this.email
      }
      mail.toAdmin(data)
      this.successMessage = mail.successMessage
      this.errorMessage = mail.errorMessage
      this.email = mail.email
    }
  },
  mounted() {
    this.baseURL = this.getBaseURL()
    this.getSlide()
  }
}
</script>
<style>
@media (max-width: 768px) {
  .card-img-overlay {
    padding: 10px;
  }

  .text-show {
    font-size: 20px;
  }

  .card-img-overlay .card {
    width: 100%;
  }
  .contact {
    display: none;
  }
}
</style>