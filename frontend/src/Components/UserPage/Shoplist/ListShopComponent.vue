<template>
  <div>
    <!-- <img class="w-100 h-95" src="../../../Images/shop1.jpg" alt="Image"> -->
    <section>
      <div class="container px-4 px-lg-5 mt-3 pt-3">
        <div class="input-group mb-3">
          <!-- search Shop -->
          <div class="relative md:w-auto w-50 md:mt-0">
            <div class="absolute inset-y-0 left-0 flex items-center pl-5 pointer-events-none">
              <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                  d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                  clip-rule="evenodd"></path>
              </svg>
            </div>
            <input type="text" id="search-navbar" v-model="searchQuery" @input="searchService"
              class="block w-full p-2 pl-10 text-sm text-blue-900 border border-blue-300 rounded-full bg-blue-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-blue-600 dark:placeholder-blue-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
              placeholder="Search shop here..." />
          </div>
        </div>
        <div class="my-3 px-lg-2 flex d-flex align-items-center pb-3 pt-3">
          <router-link to="/" class="nav-link my-3 text-xl font-bold">Home > </router-link>
          <div class="text-lg font-bold text-pink-500"> {{ provinceName }}</div>
        </div>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
          <div class="col mb-10" v-for="store in filteredStores" :key="store.id" style="cursor: pointer">
            <router-link class="link-underline link-underline-opacity-0"
              :to="{ name: 'listService', params: { id: store.id } }">
              <div @click="handleStoreClick(store)" class="card h-100 hover-shadow">
                <img v-if="store.shop_profile !== null" class="card-img-top"
                  :src="'http://127.0.0.1:8000' + store.shop_profile" alt="Store Image"
                  style="width: auto; height: 10rem" />
                <img v-else class="card-img-top" :src="'https://via.placeholder.com/100'" alt="Store Image" />
                <div class="card-body">
                  <div class="text-start">
                    <h5 class="text-pink-500">Shop: {{ store.shop_name }}</h5>
                    <p class="mb-0">Adress: {{ store.address.address }}</p>
                  </div>
                  <div class="d-flex justify-content-start">
                    <span
                      class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-green-400 border border-green-400">Open</span>
                    <div class="text-gray-700 font-bold">Hours 8:00 AM - 7:00 PM</div>
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
import { defineComponent } from 'vue'
import { useSalonStore } from '../../../stores/store'
const useSalon = useSalonStore()
export default defineComponent({
  data() {
    return {
      searchQuery: '',
      stores: [],
      provinceName: null,
      selectedProvince: null
    }
  },
  computed: {
    filteredStores() {
      return this.stores.filter(store => {
        const searchLower = this.searchQuery.toLowerCase();
        return store.shop_name.toLowerCase().includes(searchLower);
      });
    }
  },
  async mounted() {
    await this.fetchStoresByProvinceId(this.$route.params.id)
  },
  methods: {
    async fetchStoresByProvinceId(provinceId: number) {
      await useSalon.getAllStores(provinceId)
      this.stores = useSalon.stores
      this.provinceName = useSalon.province
    },
    handleStoreClick(store: any) {
      // Emit an event to the parent component
      this.$emit('storeClicked', store)
    }
  }
})
</script>

<style scoped>
.hover-shadow:hover {
  box-shadow: 0 0 40px rgba(245, 21, 178, 0.3);
  transition: all 0.3s ease-in-out;
  transform: scale(1.05);
  transition: all 0.3s ease-in-out;
}
</style>
