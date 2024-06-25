<template>
  <div class="bg-white">
    <h2 class="text-center pt-23">Find us in your area</h2>
    <div class="pt-5 row row-cols-1 row-cols-md-3 g-4">
      <div
        v-for="location in locations"
        :key="location.id"
        class="card text-white col-3 shadow card-hover "
      >
        <img class="Image" :src="location.image" alt="Location Image" />
        <div class="card-img-overlay d-flex align-items-end justify-content-end">
          <button class="btn bg-light text-dark" type="button">
            <b>{{ location.province_name }}</b>
          </button>
        </div>
      </div>
    </div>
    <div class="p-15 d-flex justify-content-start bg-white">
      <h2>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet nulla ipsum nisi. Voluptatum
        quia, numquam ipsa doloremque nemo veniam? Earum!
      </h2>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  // name: "StoreByProvince",
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
        let provinces = response.data.data;
        let locations = [];
        for (let province_name in provinces) {
          if (Object.prototype.hasOwnProperty.call(provinces, province_name)) {
            provinces[province_name].forEach((shop) => {
              console.log(shop.address.province.image, province_name);
              locations.push({
                name: shop.name,
                image: shop.address.province.image,
                province_name: province_name,
                province_image: shop.address.province.image,

              });
            })
          }
        }
        this.locations = locations;
      } catch (error) {
        console.error('Error fetching locations:', error)
      }
    }
  }
}
</script>

<style>
.Image {
  width: 100%;
  height: 100%;
  object-fit: cover;
}
.card-hover:hover {
  transform: scale(1.04);
  transition: all 0.3s ease-in-out;
}
</style>
