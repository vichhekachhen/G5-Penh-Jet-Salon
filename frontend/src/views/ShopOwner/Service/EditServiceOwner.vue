<template>
  <div>
    <v-sheet class="pa-10" rounded>
      <v-card class="mx-auto px-2 py-4" max-width="900">
        <v-form @submit.prevent="onSubmitUpdate" enctype="multipart/form-data">
          <v-file-input
            type="file"
            accept="image/jpeg,image/png,image/jpg,image/gif,image/svg"
            label="Image"
            class="mb-2"
            v-model="image"
          ></v-file-input>
          <v-text-field
            v-model="service_name"
            :readonly="loading"
            :rules="[required]"
            class="mb-2"
            label="Name"
            clearable
          ></v-text-field>
          <v-text-field
            v-model="description"
            :readonly="loading"
            :rules="[required]"
            label="Description"
            placeholder="Enter your description"
            clearable
          ></v-text-field>
          <v-text-field type="number"
            v-model="price"
            :readonly="loading"
            :rules="[required, isNumber]"
            label="Price"
            placeholder="Enter your Price"
            clearable
          ></v-text-field>
          <v-text-field
            v-model="discount" type="number"
            :readonly="loading"
            :rules="[required, isNumber]"
            label="Discount"
            placeholder="Enter your Discount"
            clearable
          ></v-text-field>
          <v-text-field type="number"
            v-model="duration"
            :readonly="loading"
            :rules="[required, isNumber]"
            label="Duration"
            placeholder="Enter your Duration"
            clearable
          ></v-text-field>
          <el-form-item :error="categoryError">
            <b>Select a category</b>
            <select
              class="form-select"
              aria-label="Default select example"
              v-model="selectedCategory"
              v-if="!isLoading && !error"
            >
              <option
                v-for="category in categoryStore.categories"
                :key="category.id"
                :value="category.id"
              >
                {{ category.name }}
              </option>
            </select>
          </el-form-item>
          <br />
          <v-btn :loading="loading" color="success" size="large" type="submit">Submit</v-btn>
          <router-link to="/services">
            <v-btn class="ml-3" color="success" size="large">Come Back</v-btn>
          </router-link>
        </v-form>
      </v-card>
    </v-sheet>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'
import { useCategoryStore } from '../../../stores/category'
import { useServiceStore } from '../../../stores/service'
import { useRoute } from 'vue-router'

// Get the route parameters
const route = useRoute()
const id = route.params.id
const serviceStore = useServiceStore()
const categoryStore = useCategoryStore()
const error = ref<string | null>(null)
const isLoading = ref(false)

// Form fields
const image = ref<File | null>(null)
const service_name = ref('')
const description = ref('')
const price = ref<number | null>(null)
const discount = ref<number | null>(null)
const duration = ref('')
const selectedCategory = ref<string | null>(null)

const loading = ref(false)
const required = (v: any) => !!v || 'Field is required'
const isNumber = (v: any) => !isNaN(v) || 'Must be a number'

// Fetch all categories
const fetchCategories = async () => {
  await categoryStore.getAllCategories()
}

// Populate the form with the existing service details
const showService = async () => {
    const service = await serviceStore.showserviceOwner(id)
    if (serviceStore.serviceShow) {
      const services = serviceStore.serviceShow
      service_name.value = services.service_name
      description.value = services.description
      price.value = services.price
      discount.value = services.discount
      duration.value = services.duration
      selectedCategory.value = services.category_id
    }
    return service
}

onMounted(() => {
  fetchCategories()
  showService()
})

const onSubmitUpdate = async () => {
  if (
    image.value ||
    service_name.value ||
    price.value ||
    discount.value ||
    duration.value ||
    selectedCategory.value
  ) {
    const formData = new FormData()
    if (image.value) {
      formData.append('image', image.value)
    }
    formData.append('service_name', service_name.value)
    formData.append('description', description.value)
    formData.append('price', price.value.toString())
    formData.append('discount', discount.value.toString())
    formData.append('duration', duration.value)
    formData.append('category_id', selectedCategory.value)

    serviceStore.updateserviceOwner(id, formData)
  }
}
</script>