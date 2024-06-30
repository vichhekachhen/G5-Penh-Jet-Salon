<template>
  <div class="bg-white p-5">
    <h2 class="text-center pt-20">Find us in your area</h2>
    <div class="row gap-4">
      <div
        v-for="location in locations"
        :key="location.id"
        class="card text-white col-3 shadow card-hover m-5 p-1"
      >
      <img
        class="card-img-top"
        :src="location.province_image"
        alt=""
        style="height: 250px"/>
        <div class="card-img-overlay d-flex align-items-end justify-content-end">
          <button class="btn bg-light text-dark" type="button">
            <b>{{ location.province_name}}</b>
          </button>
        </div>
      </div>
    </div>
    <div class="pt-5 pl-10 d-flex justify-content-start bg-white">
      <h2>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet nulla ipsum nisi. Voluptatum
        quia, numquam ipsa doloremque nemo veniam? Earum!
      </h2>
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
        const response = await axios.get('http://127.0.0.1:8000/api/store/StoreByProvince')
        let provinces = response.data.data
        let locations = []

        for (let province_name in provinces) {
          if (Object.prototype.hasOwnProperty.call(provinces, province_name)) {
            let province_image = ''
            let id = null;
            if (provinces[province_name].length > 0) {
              province_image = provinces[province_name][0].address.province.image
              id = provinces[province_name][0].address.province.province_id
            }
            locations.push({
              province_id: id,
              province_name: province_name,
              province_image:'http://127.0.0.1:8000'+ province_image,
              stores: provinces[province_name]
            })
          }
        }
        this.locations = locations
      } catch (error) {
        console.error('Error fetching locations:', error)
      }
    }
  }
};
</script>

<style>
.card-hover:hover { 
  transform: scale(1.04);
  transition: all 0.3s ease-in-out;
}
</style>
