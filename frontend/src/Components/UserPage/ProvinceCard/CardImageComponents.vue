<template>
  <div class="bg-white p-5">
    <h1 class="text-center my-3">Find us in your area</h1>
    <div class="row gap-4">
      <div v-for="location in locations" :key="location.id"
        class="card text-white col-3 shadow card-hover p-1 d-flex justify-content-between ml-6 mt-3 gap-6">
        <img class="card-img-top" :src="location.province_image" alt="" style="height: auto" />
        <div class="card-img-overlay d-flex align-items-end justify-content-end">
          <button class="btn bg-light text-dark" type="button">
            <router-link class="link-underline link-underline-opacity-0"
              :to="{ name: 'listShop', params: { id: location.province_id } }"><b>{{ location.province_name
                }}</b></router-link>
          </button>
        </div>
      </div>
    </div>
    <div class="pt-5 ">
      <h2>Our goal:</h2>
      <h4>Decide on the service(s) you would like to receive (e.g. haircut, color, manicure, pedicure, etc.) <br>
        Determine the date and time that works best for your schedule <br>
        Contact the salon directly to check availability for your preferred date and time <br>
        Request the name of the stylist or service provider you would like, if you have a preference <br>
      </h4>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      locations: []
    }
  },
  mounted() {
    this.fetchLocations()
  },
  methods: {
    async fetchLocations() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/store/StoreByProvince')
        let provinces = response.data.data
        let locations = []

        for (let province_name in provinces) {
          if (Object.prototype.hasOwnProperty.call(provinces, province_name)) {
            let province_image = ''
            let id = null
            if (provinces[province_name].length > 0) {
              province_image = provinces[province_name][0].address.province.image
              id = provinces[province_name][0].address.province.province_id
            }
            locations.push({
              province_id: id,
              province_name: province_name,
              province_image: 'http://127.0.0.1:8000' + province_image,
              stores: provinces[province_name]
            })
          }
        }
        this.locations = locations
      } catch (error) {
        console.error('Error fetching locations:', error)
      }
    },

  }
}
</script>

<style>
.card-hover:hover {
  transform: scale(1.04);
  transition: all 0.3s ease-in-out;
}
</style>
