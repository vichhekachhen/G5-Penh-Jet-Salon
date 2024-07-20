<template>
  <div class="bg-gray-100">
    <nav class="bg-pink-600 p-4 sticky top-0 z-50">
      <div class="flex items-center justify-between">
        <h5 class="animate-fade-in text-white font-bold text-2xl md:text-3xl lg:text-4xl uppercase p-4">Welcome to My
          Salon</h5>
        <button @click="toggleNavbar" class="text-white focus:outline-none md:hidden">
          <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
          </svg>
        </button>
      </div>
      <div :class="{
        'block transition-all duration-300 ease-in-out': isNavbarOpen,
        hidden: !isNavbarOpen
      }" class="mt-2 md:flex md:items-center md:justify-between">
        <div class="flex flex-col md:flex-row md:space-x-4">
          <button class="text-white hover:underline ml-9 mr-9">All Categories</button>
          <button class="text-white hover:underline mr-8">Man</button>
          <button class="text-white hover:underline mr-8">Woman</button>
          <button class="text-white hover:underline mr-8">Product</button>
        </div>
        <div class="relative w-full mt-2 md:mt-0 md:w-60">
          <div class="flex items-center">
            <i class="bi bi-search absolute left-3 text-gray-500"></i>
            <input type="text" v-model="searchQuery" @input="searchService"
              class="block w-full pl-10 pr-4 py-2 text-sm text-gray-900 border border-gray-300 rounded-md bg-gray-50 focus:ring focus:ring-pink-400"
              placeholder="Search..." />
          </div>
        </div>
      </div>
    </nav>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6 p-3">
      <div class="col-span-2 overflow-y-auto">
        <form @submit.prevent="create">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div v-for="service in filteredServices" :key="service.id"
              class="bg-white rounded-lg shadow-md overflow-hidden flex items-center mb-6">
              <div class="flex-1 p-3">
                <h5 class="text-lg font-semibold text-pink-500">{{ service.service_name }}</h5>
                <p class="text-pink-500 text-xl font-bold">
                  <span v-if="service.discount" class="line-through text-gray-500">${{ service.price }}</span>
                  <span v-else class="text-gray-500">${{ service.price }}</span>
                  <span v-if="service.discount" class="text-gray-500 ml-2">${{ service.discount }}</span>
                </p>
                <p class="text-gray-700">{{ service.description }}</p>
              </div>
              <div class="relative w-30 h-30 mr-5">
                <img class="w-full h-full object-cover rounded-lg" :src="baseURL + service.image" alt="Service Image" />
                <button @click="addToCart(service.id)"
                  class="absolute bottom-2 right-2 bg-white rounded-full p-1 shadow-md">
                  <svg class="h-6 w-6 text-pink-500" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                  </svg>
                </button>
              </div>
            </div>
          </div>
        </form>
      </div>

      <div class="col-span-1">
        <div class="sticky top-40">
          <div class="bg-white rounded-lg shadow-md overflow-hidden p-3">
            <div class="max-h-77 overflow-y-auto">
              <div class="text-center">
                <h4 class="text-pink-500 font-semibold my-2">Services in Cart</h4>
                <hr />
              </div>
              <div class="flex flex-col space-y-4">
                <div v-if="cardItems.cards.length > 0">
                  <div v-for="item in cardItems.cards" :key="item.id" class="flex items-center space-x-4">
                    <img class="w-16 h-16 object-cover rounded-lg" :src="baseURL + item.service.image" alt="Item" />
                    <div class="flex-1">
                      <h5 class="text-base font-bold text-gray-900">
                        {{ item.service.service_name }}
                      </h5>
                      <p class="text-red-500 text-base font-bold">
                        ${{ item.service.discount ? item.service.discount : item.service.price }}
                      </p>
                    </div>
                    <div class="flex items-center space-x-2">
                      <button @click="removeFromCart(item.id)" class="border-none bg-white">
                        <svg class="h-6 w-6 text-red-500" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                          stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                          <line x1="4" y1="7" x2="20" y2="7" />
                          <line x1="10" y1="11" x2="10" y2="17" />
                          <line x1="14" y1="11" x2="14" y2="17" />
                          <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2l1-12" />
                          <path d="M9 7v-3a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v3" />
                        </svg>
                      </button>
                      <span class="text-gray-400 font-bold p-2">{{ item.quantity }}</span>
                      <button @click="addToCart(item.service_id)" class="border-none bg-white">
                        <svg class="h-6 w-6 text-red-500" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                          stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                          <line x1="12" y1="5" x2="12" y2="19" />
                          <line x1="5" y1="12" x2="19" y2="12" />
                        </svg>
                      </button>
                    </div>
                  </div>
                </div>
                <div v-else class="text-center text-gray-500 font-semibold">
                  Your cart is empty.
                </div>
              </div>
            </div>
            <div class="border-t mt-4 pt-4">
              <div class="flex justify-between items-center">
                <span class="font-semibold text-gray-900">Total:</span>
                <span class="text-gray-900 text-red font-bold">${{ calculateTotalPrice() }}</span>
              </div>
              <button class="mt-4 bg-pink-500 text-white w-full py-2 rounded-lg shadow-md">
                Check Order
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, computed, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import { useServiceStore } from '../../../stores/service'
import { useCardStore } from '../../../stores/pre-booking'
import baseURL from '../../../api/url'

const route = useRoute()
const serviceStore = useServiceStore()
const cardItems = useCardStore()
const searchQuery = ref('')
const isNavbarOpen = ref(false)

const toggleNavbar = () => {
  isNavbarOpen.value = !isNavbarOpen.value
}

const calculateTotalPrice = () => {
  return cardItems.cards.reduce((total, item) => {
    return total + (item.service.discount || item.service.price) * item.quantity
  }, 0)
}

const fetchService = async () => {
  const id = route.params.id
  await serviceStore.getService(id)
}

const addToCart = (serviceId: number) => {
  cardItems.addCard(serviceId)
}

const removeFromCart = (serviceId: number) => {
  cardItems.removeCard(serviceId)
}

const filteredServices = computed(() => {
  if (!searchQuery.value) {
    return serviceStore.services
  }
  return serviceStore.services.filter((service) =>
    service.service_name.toLowerCase().includes(searchQuery.value.toLowerCase())
  )
})

const fetchAllCardService = async () => {
  await cardItems.fetchAllCards()
}

onMounted(async () => {
  await fetchService()
  await fetchAllCardService()
})
</script>

<style>
@keyframes fadeIn {
  from {
    opacity: 0;
  }

  to {
    opacity: 1;
  }
}

.animate-fade-in {
  animation: fadeIn 2s ease-in-out;
}

.text-white {
  color: #ffffff;
}

.font-bold {
  font-weight: 700;
}

.text-2xl {
  font-size: 1.5rem;
  /* 24px */
}

.md\:text-3xl {
  font-size: 1.875rem;
  /* 30px */
}

.lg\:text-4xl {
  font-size: 2.25rem;
  /* 36px */
}

.uppercase {
  text-transform: uppercase;
}

.p-4 {
  padding: 1rem;
}


@media (min-width: 640px) and (max-width: 1024px) {
  .md\:space-x-4 {
    margin-right: 1rem; /* Adjust spacing for tablet */
  }
  .bg-white {
    padding: 1rem; /* Add padding for tablet */
  }
  .text-2xl {
    font-size: 1.75rem; /* Smaller font size for tablet */
  }
}
</style>