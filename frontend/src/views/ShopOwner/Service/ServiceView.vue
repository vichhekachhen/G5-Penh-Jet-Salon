<template>
  <div class="p-5">
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
      <template v-slot:item.actions="{ item }">
        <v-icon small @click="editItem(item)" class="text-blue">mdi-pencil</v-icon>
        <v-icon small @click="deleteItem(item)" class="text-red ml-2">mdi-delete</v-icon>
      </template>

      <template v-slot:tfoot>
        <tr>
          <td>
            <v-text-field
              v-model="searchName"
              class="ma-3 w-100"
              density="compact"
              placeholder="Search name..."
              hide-details
              @input="loadItems"
            ></v-text-field>
          </td>
        </tr>
      </template>
    </v-data-table-server>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted, watch } from 'vue'
import { useRouter } from 'vue-router'
import createServicesComponent from '@/Components/ServiceOwner/CreateServiceComponent.vue'
import { useServiceStore } from '../../../stores/service'
import { debounce } from 'lodash'

const router = useRouter()
const service = useServiceStore()
const headers = ref([
  { title: 'Profile', align: 'start', key: 'image' },
  { title: 'Name service', key: 'service_name', align: 'start' },
  { title: 'Description', key: 'description', align: 'start' },
  { title: 'Price', key: 'price', align: 'start' },
  { title: 'Discount', key: 'discount', align: 'start' },
  { title: 'Duration', key: 'duration', align: 'start' },
  { title: 'Actions', key: 'actions', align: 'start', sortable: false }
])

const serverItems = ref([])
const loading = ref(true)
const totalItems = ref(0)
const search = ref('')
const searchName = ref('')
const minCalories = ref(0)

const fetchServices = async () => {
  try {
    await service.getServiceOwner()
    loadItems({ page: 1, itemsPerPage: 10, sortBy: [] })
  } catch (error) {
    console.error('Failed to fetch services', error)
  }
}

const serverAPI = {
  async fetch({ page, itemsPerPage, sortBy, search, minCalories }) {
    return new Promise((resolve, reject) => {
      setTimeout(() => {
        try {
          let items = service.serviceOwner.slice()

          if (search) {
            items = items.filter((item) =>
              item.service_name.toLowerCase().includes(search.toLowerCase())
            )
          }

          if (minCalories) {
            items = items.filter((item) => item.calories >= minCalories)
          }

          if (sortBy.length) {
            const sortKey = sortBy[0].key
            const sortOrder = sortBy[0].order
            items.sort((a, b) => {
              const aValue = a[sortKey]
              const bValue = b[sortKey]
              if (sortOrder === 'desc') {
                return bValue > aValue ? 1 : -1
              } else {
                return aValue > bValue ? 1 : -1
              }
            })
          }

          const start = (page - 1) * itemsPerPage
          const end = start + itemsPerPage
          const paginated = items.slice(start, end)

          resolve({ items: paginated, total: items.length })
        } catch (error) {
          reject(error)
        }
      }, 1000)
    })
  }
}

const loadItems = async ({ page, itemsPerPage, sortBy }) => {
  loading.value = true
  try {
    const { items, total } = await serverAPI.fetch({
      page,
      itemsPerPage,
      sortBy,
      search: searchName.value,
      minCalories: minCalories.value
    })
    serverItems.value = items
    totalItems.value = total
  } catch (error) {
    console.error('Failed to load items', error)
  } finally {
    loading.value = false
  }
}
const deleteItem = async (item) => {
  try {
    await service.deleteserviceOwner(item.id)
    loadItems({ page: 1, itemsPerPage: 10, sortBy: [] })
    fetchServices()
  } catch (error) {
    console.error('Failed to delete item', error)
  }
}

const editItem = async (item) => {
  router.push({ name: 'UpdateService', params: { id: item.id } })
}

onMounted(() => {
  fetchServices()
})

watch(
  searchName,
  debounce(() => {
    loadItems({ page: 1, itemsPerPage: 10, sortBy: [] })
  }, 300)
)
</script>