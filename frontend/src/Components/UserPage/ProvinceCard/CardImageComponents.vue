<template>
  <div class="bg-white p-5">
    <h2 class="text-center pt-20">Find us in your area</h2>
    <div class="pt-5 d-flex justify-content-between row row-cols-1 row-cols-md-4 g-0">
      <div
        v-for="location in locations"
        :key="location.id"
        class="card text-white col-4 shadow card-hover m-5"
      >
      <img
        class="card-img-top"
        :src="location.shop_profile"
        alt=""
        style="height: 250px"/>
        <div class="card-img-overlay d-flex align-items-end justify-content-end">
          <button class="btn bg-light text-dark" type="button">
            <b>{{ location.shop_name }}</b>
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
        const response = await axios.get('http://127.0.0.1:8000/api/store/list');
        let listProvince = response.data.data
        listProvince.forEach(element => {
          element.shop_profile = 'http://127.0.0.1:8000' + element.shop_profile;
          console.log(element.shop_profile)
          
        });
        if (response.data.data) {
          this.locations = response.data.data;
        }
      } catch (error) {
        console.error('Error fetching locations:', error);
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
