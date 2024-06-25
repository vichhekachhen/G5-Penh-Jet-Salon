<template>
  <div class="bg-white">
    <h2 class="text-center pt-23">Find us in your area</h2>
    <div class="d-flex justify-content-around pt-5">
      <div v-for="location in locations" :key="location.name" class="card text-white col-3 shadow card-hover">
        <img class="Image" :src="location.img">
        <div class="card-img-overlay d-flex align-items-end justify-content-end">
          <button class="btn bg-light text-dark" type="button">
            <b>{{ location.name }}</b>
          </button>
        </div>
      </div>
    </div>
      {{locations}}
    <div class="p-15 d-flex justify-content-start bg-white">
      <h2>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet nulla ipsum nisi. Voluptatum quia, numquam ipsa doloremque nemo veniam? Earum!</h2>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  // name: "StoreByProvince",
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
        const response = await axios.get("http://127.0.0.1:8000/api/store/StoreByProvince");
        console.log(response.data);
        if (response.data.success) {
          this.locations = response.data.data;
        }
      } catch (error) {
        console.error("Error fetching locations:", error);
      }
    }
  }
};
</script>

<style>
.Image {
  width: 100%;
  height: 100%;
  overflow: hidden;
}
.card-hover:hover {
  transform: scale(1.04);
  transition: all 0.3s ease-in-out;
}
</style>