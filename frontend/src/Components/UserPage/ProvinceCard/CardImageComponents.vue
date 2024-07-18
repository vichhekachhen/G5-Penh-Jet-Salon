<template>
  <div class="bg-white p-5">
    <div class="my-5 text-center d-none d-md-block">
      <div class="text-center bg-gray-100 py-8 px-4">
        <h5 class="text-gray-800 font-bold">Welcome to Penh Jit Salon</h5>
        <p class="text-gray-600">
          Discover a world of beauty and wellness. Book your appointment today and embark on a
          journey of self-care and rejuvenation.
        </p>
      </div>
      <hr />
    </div>
    <h4 class="text-center my-5 font-weight-bold">Find us in your area</h4>

    <!-- Original layout for larger screens (desktop and tablet) -->
    <div class="container container1">
      <div class="row gap-4 d-none d-sm-flex">
        <div
          v-for="location in locations"
          :key="location.id"
          class="card text-white col-12 col-md-3 shadow card-hover p-1 mb-3"
        >
          <router-link
            class="link-underline link-underline-opacity-0"
            :to="{ name: 'listShop', params: { id: location.province_id } }"
          >
            <img class="card-img-top" :src="location.province_image" alt="" style="height: auto" />
            <div class="card-img-overlay d-flex align-items-end justify-content-end">
              <button class="btn bg-light text-dark" type="button">
                <b>{{ location.province_name }}</b>
              </button>
            </div>
          </router-link>
        </div>
      </div>

      <!-- Responsive layout for phone screens -->
      <div class="d-block d-sm-none text-center">
        <div class="row">
          <div
            v-for="location in locations"
            :key="location.id"
            class="card text-white col-6 shadow card-hover p-1 mb-3"
          >
            <router-link
              class="link-underline link-underline-opacity-0"
              :to="{ name: 'listShop', params: { id: location.province_id } }"
            >
              <img class="card-img-top" :src="location.province_image" alt="" style="height: auto" />
              <div class="card-img-overlay d-flex align-items-end justify-content-end">
                <button class="btn bg-light text-dark" type="button">
                  <b>{{ location.province_name }}</b>
                </button>
              </div>
            </router-link>
          </div>
        </div>
      </div>
    </div>

    <div class="pt-5 my-5 text-center">
      <hr class="my-5" />
      <h4 class="font-weight-bold text-black">About Us</h4>
      <div class="text-muted mx-auto" style="max-width: 600px">
        <p class="my-4">
          At Penh Jit Salon, we are passionate about beauty, wellness, and empowering our clients to
          embrace their natural radiance. With over a decade of trusted service in the community, we
          offer a wide range of services tailored to your needs. From cutting-edge hair treatments
          to luxurious spa experiences, we create a sanctuary where you can relax, recharge, and
          emerge feeling rejuvenated.
        </p>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      locations: []
    };
  },
  mounted() {
    this.fetchLocations();
  },
  methods: {
    async fetchLocations() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/store/StoreByProvince');
        const provinces = response.data.data;
        const locations = [];

        for (const province_name in provinces) {
          if (Object.prototype.hasOwnProperty.call(provinces, province_name)) {
            let province_image = '';
            let id = null;
            if (provinces[province_name].length > 0) {
              province_image = provinces[province_name][0].address.province.image;
              id = provinces[province_name][0].address.province.province_id;
            }
            locations.push({
              province_id: id,
              province_name: province_name,
              province_image: 'http://127.0.0.1:8000' + province_image,
              stores: provinces[province_name]
            });
          }
        }
        this.locations = locations;
      } catch (error) {
        console.error('Error fetching locations:', error);
      }
    }
  }
};
</script>

<style scoped>
.card {
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Optional: Adds shadow for a card effect */
}

.card-hover:hover {
  transform: scale(1.04);
  transition: all 0.3s ease-in-out;
}

@media (max-width: 576px) {
  .card {
    padding: 1rem;
  }
  .container1 {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 200px; /* Adjust the gap value as needed */
        /* background-color: brown; */
    }
}
</style>
