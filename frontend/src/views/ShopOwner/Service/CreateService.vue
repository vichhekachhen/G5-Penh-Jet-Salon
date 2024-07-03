<template>
<div class="p-10">
    <createServicesComponent></createServicesComponent>
    <v-data-table-server
      :headers="headers"
      :api="fetchServices"
      :server-items-length="totalItems"
      :items="serverItems"
      :items-length="totalItems"
      :loading="loading"
      :search="search"
      item-value="service_name"
      @update:options="loadItems"
      
    >
    </v-data-table-server>

</div>
</template>

<script setup lang="ts">
import createServicesComponent from "@/Components/ServiceOwner/CreateServiceComponent.vue"
import { ref, onMounted } from 'vue'
import axiosInstance from '@/plugins/axios'

const desserts = ref([])
const fetchServices = async () => {
  try {
    const response = await axiosInstance.get('/service/list')
    desserts.value = response.data.data
  } catch (error) {
    console.error('Error fetching services:', error.message)
  }
}

onMounted(() => {
  fetchServices()
})

const serverAPI = {
  async fetch({ page, itemsPerPage, sortBy }) {
    return new Promise(resolve => {
      setTimeout(() => {
        const start = (page - 1) * itemsPerPage
        const end = start + itemsPerPage
        const items = desserts.value.slice()

        if (sortBy.length) {
          const sortKey = sortBy[0].key
          const sortOrder = sortBy[0].order
          items.sort((a, b) => {
            const aValue = a[sortKey]
            const bValue = b[sortKey]
            return sortOrder === 'desc' ? bValue - aValue : aValue - bValue
          })
        }

        const paginated = items.slice(start, end)

        resolve({ items: paginated, total: items.length })
      }, 50)
    })
  },
}

const headers = ref([
  {
    title: 'Profile',
    align: 'start',
    sortable: false,
    key: 'service_name',
  },
  { title: 'Name', key: 'service_name', align: 'end' },
  { title: 'Description', key: 'description', align: 'end' },
  { title: 'Price', key: 'price', align: 'end' },
  { title: 'Discount', key: 'discount', align: 'end' },
  { title: 'Duration', key: 'duration', align: 'end' },
])

const search = ref('')
const serverItems = ref([])
const loading = ref(true)
const totalItems = ref(0)

const loadItems = ({ page, itemsPerPage, sortBy }) => {
  loading.value = true
  serverAPI.fetch({ page, itemsPerPage, sortBy }).then(({ items, total }) => {
    serverItems.value = items
    totalItems.value = total
    loading.value = false
  })
}
</script>