<template>
  <div>
    <div class="flex items-center justify-center p-3 flex-wrap bg-pink-500 sticky top-0 z-90">
        <button type="button" class="text-blue-700 hover:text-white border border-blue-600 bg-white hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-full text-base font-medium px-5 py-2.5 text-center me-3 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:bg-gray-900 dark:focus:ring-blue-800">
          All categories
        </button>
        <button type="button" class="text-blue-900 border border-white hover:border-blue-200 dark:border-blue-900 dark:bg-blue-900 dark:hover:border-blue-700 bg-white focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-full text-base font-medium px-5 py-2.5 text-center me-3 dark:text-white dark:focus:ring-blue-800">
          Man
        </button>
        <button type="button" class="text-blue-900 border border-white hover:border-gray-200 dark:border-blue-900 dark:bg-blue-900 dark:hover:border-blue-700 bg-white focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-full text-base font-medium px-5 py-2.5 text-center me-3 dark:text-white dark:focus:ring-blue-800">
          Woman
        </button>
        <button type="button" class="text-blue-900 border border-white hover:border-blue-200 dark:border-blue-900 dark:bg-blue-900 dark:hover:border-blue-700 bg-white focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-full text-base font-medium px-5 py-2.5 text-center me-3 dark:text-white dark:focus:ring-blue-800">
          Product
        </button>
        <!-- search service  -->
        <div class="relative w-full md:w-auto ml-5">
          <div class="absolute inset-y-0 left-0 flex items-center pl-5 pointer-events-none ">
            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
            </svg>
          </div>
            <input type="text" id="search-navbar" class="block w-full p-2 pl-10 text-sm text-blue-900 border border-gray-300 rounded-full bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search...">
        </div>
    </div>
    
    <div class="grid grid-flow-row-dense grid-cols-3 mt-6">
      <div class="col-span-2 ml-6 overflow-y-auto">
        <div class="grid grid-cols-2 mb-0 gap-x-5 gap-y-0 ">
          <!-- card service -->
          <div v-for="service in serviceStore.services" :key="service" 
              class="max-w-lg mx-auto w-100 h-40 bg-white rounded-lg shadow-md overflow-hidden flex items-center mb-6 ">
              <div class="flex-1 p-3">
                  <div class="text-pink-500 text-xl font-bold">
                    <h5 class="text-lg font-semibold text-pink-500">{{ service.service_name }}</h5>
                  </div>
                  <p class="text-pink-500 text-xl font-bold">
                    <span v-if="service.discount" class="line-through text-gray-500">${{ service.price }}</span>
                    <span v-else class="text-gray-500">${{ service.price }}</span>
                    <span v-if="service.discount" class="text-gray-500 ml-2">${{ service.discount }}</span>
                    <span v-else class="text-gray-500 ml-2">{{ service.discount }}</span>
                  </p>
                  <p class="text-gray-700">
                      {{ service.description }}
                  </p>
                    <!-- <span class=" mb-2 flex items-end">
                          <a href="#">
                            <svg class="h-6 w-6 text-red-500 " viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                              <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                            </svg>
                          </a>
                    </span> -->
              </div>
              <div class="relative w-30 h-30 mr-5">
                <img class="w-full h-full object-cover rounded-lg"
                  :src="baseURL+service.image" alt="Service Image"/>
                <button class="absolute bottom-2 right-2 bg-white rounded-full p-1 shadow-md">
                  <svg class="h-6 w-6 text-pink-500"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <line x1="12" y1="5" x2="12" y2="19" />  <line x1="5" y1="12" x2="19" y2="12" /></svg>
                </button>
              </div>
          </div>
          <!-- card service -->
        </div>
      </div>

      <!-- booking -->
      <div class="col-span-1">
        <div class="sticky top-90 z-10">
          <div class="max-w-sm mx-auto bg-white rounded-lg shadow-md overflow-hidden p-3 ">
              <div class="max-h-49 overflow-y-auto pl-3">
                <div class="text-center">
                  <h4 class="text-pink-500 font-semibold">Your Cart</h4>
                </div>
                <div class="flex flex-col space-y-4">
                <!-- cart items -->
                <div class="flex items-center space-x-4">
                  <img class="w-16 h-16 object-cover rounded-lg" src="https://i.pinimg.com/564x/7e/95/ca/7e95ca066aed1767823721ad53e5d83a.jpg" alt="Item" />
                  <div class="flex-1">
                    <h5 class="text-base font-bold text-gray-900">n</h5>
                    <p class="text-red-500 text-base font-bold">
                      86<span class="line-through text-gray-500">9098</span>
                    </p>
                  </div>

                  <div class="flex items-center rounded-full">
                    <button class="border-none bg-white">
                      <svg class="h-6 w-6 text-red-500" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <line x1="4" y1="7" x2="20" y2="7" />
                        <line x1="10" y1="11" x2="10" y2="17" />
                        <line x1="14" y1="11" x2="14" y2="17" />
                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                      </svg>
                    </button>
                    <span class="text-gray-400 font-bold p-2">1</span>
                    <button class="border-none bg-white">
                      <svg class="h-6 w-6 text-red-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                      </svg>
                    </button>
                  </div>
                </div>
                <!-- end cart items -->
               </div>
              </div>
              <!-- total price -->
              <div class="border-t mt-4 pt-4">
                <div class="flex justify-between items-center">
                  <span class="font-semibold text-gray-900">Total:</span>
                  <span class="text-gray-900">$2.80</span>
                </div>
                <button class="mt-4 bg-pink-500 text-white w-full py-2 rounded-lg shadow-md">
                  Booking
                </button>
              </div>
          </div>
        </div>
      </div>  

    </div>
</div>
</template>

<script setup lang="ts">
import { onMounted, ref } from 'vue'; 
import { useRoute } from 'vue-router';
import { useServiceStore } from '../../../stores/service';
import baseURL from '../../../api/url'

const route = useRoute();
const serviceStore = useServiceStore();
const cart = ref([]);

const fetchService = async () => {
  const id = route.params.id;
  await serviceStore.getService(id);
};
onMounted(async () => {
  try {
    await fetchService();
  } catch (error) {
    console.error('Error fetching service:', error);
  }
});
</script>
