<template>
  <div class="flex justify-center">
    <div class="w-1/2">
      <form class="p-8">
        <div class="mb-4">
          <div
            v-if="error !== ''"
            class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800"
            role="alert"
          >
            <svg
              class="flex-shrink-0 inline w-4 h-4 me-3"
              aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg"
              fill="currentColor"
              viewBox="0 0 20 20"
            >
              <path
                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"
              />
            </svg>
            <span class="sr-only">Info</span>
            <div>
              <span class="font-medium">{{ error }}</span>
            </div>
          </div>
          <div
            v-else
            class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
            role="alert"
          >
            <span class="font-medium">{{ address }}</span>
          </div>
          <div class="flex items-center border border-red-500 rounded-lg">
            <input
              type="text"
              class="w-full py-2 px-4 rounded-lg"
              id="search_input"
              placeholder="Enter your address"
              v-model="searchInput"
            />
            <a
              class="py-2 px-4 bg-red-500 text-white rounded-lg ml-2 cursor-pointer"
              @click.prevent="locatorButtonPressed"
            >
              Location
            </a>
          </div>
        </div>
        <button class="py-2 px-4 bg-blue-500 text-white rounded-lg">Go</button>
      </form>
    </div>
  </div>
  <div>
    <div class="text-center">
      <div ref="map" style="width: 1200px; height: 390px; margin-top: 20px"></div>
    </div>
  </div>
</template>

<script setup>
import axios from 'axios'
import component from 'element-plus/es/components/tree-select/src/tree-select-option.mjs'
import { ref, onMounted } from 'vue'

const map = ref(null)
const address = ref('')
const error = ref('')
const spinner = ref(false)
const latitude = ref('')
const longitude = ref('')

const searchInput = ref('')
let autocomplete = null

const locatorButtonPressed = () => {
  spinner.value = true

  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
      (position) => {
        getAddressFrom(position.coords.latitude, position.coords.longitude)
        latitude.value = position.coords.latitude
        longitude.value = position.coords.longitude

        showLocationOnTheMap(position.coords.latitude, position.coords.longitude)
      },
      (error) => {
        error.value = error.message
        spinner.value = false
      }
    )
  } else {
    error.value = 'Geolocation is not supported by this browser.'
    spinner.value = false
  }
  searchInput.value = ''
}

const getAddressFrom = (lat, long) => {
  axios
    .get(
      `https://maps.googleapis.com/maps/api/geocode/json?latlng=${lat},${long}&key=AIzaSyDtSAkdlKPhpaKbVV4B_m7QO2b8CrBEGJ8`
    )
    .then((response) => {
      if (response.data.error_message) {
        error.value = response.data.error_message
      } else {
        address.value = response.data.results[0].formatted_address // Adjust index as needed
      }
      spinner.value = false
    })
    .catch((error) => {
      error.value = error.message
      spinner.value = false
    })
}

const showLocationOnTheMap = (lat, long) => {
  if (window.google && window.google.maps && map.value) {
    const googleMap = new window.google.maps.Map(map.value, {
      center: { lat, lng: long },
      zoom: 15
    })

    new window.google.maps.Marker({
      position: { lat, lng: long },
      map: googleMap,
      title: 'Current Location'
    })
  } else {
    console.error('Google Maps API is not loaded')
  }
}

onMounted(() => {
  autocomplete = new google.maps.places.Autocomplete(document.getElementById('search_input'), {
    types: ['geocode'],
    componentRestrictions: {
      country: 'KH'
    }
  })

  google.maps.event.addListener(autocomplete, 'place_changed', () => {
    const place = autocomplete.getPlace()
    // console.log(place) //object of map
    // console.log(place.formatted_address) //object of map
    if (place.geometry && place.geometry.location) {
      const latitude = place.geometry.location.lat();
      const longitude = place.geometry.location.lng();
      showLocationOnTheMap(latitude, longitude);
      address.value = place.formatted_address;
    }
  })
})
</script>
