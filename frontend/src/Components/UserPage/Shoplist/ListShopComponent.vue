<template>
  <div>
    <img class="w-100 h-95" src="../../../Images/shop1.jpg" alt="Image">
    <section>
      <div class="container px-4 px-lg-5 mt-3">
        <h5 class="my-3 px-lg-2">
          <router-link to="/" class="nav-link my-5">Home ></router-link>
        </h5>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
          <div class="col" v-for="store in stores" :key="store.id" style="cursor: pointer">
            <router-link class="link-underline link-underline-opacity-0"
              :to="{ name: 'listService', params: { id: store.id } }">
              <div @click="handleStoreClick(store)" class="card h-100 hover-shadow">
                <img v-if="store.shop_profile !== null" class="card-img-top"
                  :src="'http://127.0.0.1:8000' + store.shop_profile" alt="Store Image"
                  style="width: auto; height:10rem;" />
                <img v-else class="card-img-top" :src="'https://via.placeholder.com/100'" alt="Store Image" />
                <div class="card-body">
                  <div class="text-start">
                    <h5 class="text-pink-500">Shop:{{ store.shop_name }}
                    </h5>
                    <p class="mb-0"><b>Location:</b> {{ store.address.city }}</p>
                  </div>
                  <div class="d-flex justify-content-start ">
                    <b>Rate:</b>
                    <div v-for="star in 5" :key="star" class=" bi-star-fill text-warning pl-2"></div>
                  </div>
                </div>
              </div>
            </router-link>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import axiosInstance from '@/plugins/axios';

export default defineComponent({
  data() {
    return {
      stores: [],
      selectedProvince: null,
    };
  },
  created() {
    this.fetchStoresByProvinceId(this.$route.params.id);
  },
  methods: {
    async fetchStoresByProvinceId(provinceId: number) {
      try {
        const response = await axiosInstance.get(`/store/list/${provinceId}`);
        this.stores = response.data.data;
        this.selectedProvince = response.data.province;
      } catch (error) {
        console.error('Error fetching stores:', error);
        // Display a user-friendly error message
        alert('Error fetching stores. Please try again later.');
      }
    },
    handleStoreClick(store: any) {
      // Emit an event to the parent component
      this.$emit('storeClicked', store);
    }
  },
});
</script>

<style scoped>
.hover-shadow:hover {
  box-shadow: 0 0 40px rgba(221, 13, 207, 0.3);
  transition: all 0.3s ease-in-out;
  transform: scale(1.05);
  transition: all 0.3s ease-in-out;
}
</style>