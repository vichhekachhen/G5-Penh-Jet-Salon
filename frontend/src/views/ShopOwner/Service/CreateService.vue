<template>
  <div class="app">
    <div class="id">
      <div class="p-5">
        <div class="d-flex justify-content-end">
          <button
            type="button"
            class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#ServiceModal"
            @click="openAddServiceModal"
          >
            + Add Service
          </button>
        </div>

        <!-- Modal create and update service-->
        <div
          class="modal fade"
          id="ServiceModal"
          data-bs-backdrop="static"
          data-bs-keyboard="false"
          tabindex="-1"
          aria-labelledby="ServiceModalLabel"
          aria-hidden="true"
        >
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="ServiceModalLabel">Add New Service</h5>
                <button
                  type="button"
                  class="btn-close"
                  data-bs-dismiss="modal"
                  aria-label="Close"
                  @click="resetForm"
                ></button>
              </div>
              <form @submit.prevent="createServiceOwner" enctype="multipart/form-data">
                <div class="modal-body">
                  <v-file-input
                    type="file"
                    accept="image/jpeg,image/png,image/jpg,image/gif,image/svg"
                    label="Image"
                    class="mb-2"
                    v-model="image"
                  ></v-file-input>
                  <div class="mb-3">
                    <label for="serviceName" class="form-label">Service Name</label>
                    <input
                      type="text"
                      class="form-control"
                      id="serviceName"
                      v-model="newService.service_name"
                    />
                  </div>
                  <div class="mb-3">
                    <label for="categoryName" class="form-label">Select category</label>
                    <select
                      class="form-select"
                      aria-label="select"
                      id="categoryName"
                      v-model="newService.category_id"
                    >
                      <option
                        v-for="category in categoryStore.categories"
                        :key="category.id"
                        :value="category.id"
                      >
                        {{ category.name }}
                      </option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="serviceDescription" class="form-label">Description</label>
                    <input
                      type="text"
                      class="form-control"
                      id="serviceDescription"
                      v-model="newService.description"
                    />
                  </div>
                  <div class="mb-3">
                    <label for="servicePrice" class="form-label">Price</label>
                    <input
                      type="number"
                      class="form-control"
                      id="servicePrice"
                      v-model="newService.price"
                    />
                  </div>
                  <div class="mb-3">
                    <label for="serviceDiscount" class="form-label">Discount</label>
                    <input
                      type="number"
                      class="form-control"
                      id="serviceDiscount"
                      v-model="newService.discount"
                    />
                  </div>
                  <div class="mb-3">
                    <label for="serviceDuration" class="form-label">Duration</label>
                    <input
                      type="number"
                      class="form-control"
                      id="serviceDuration"
                      v-model="newService.duration"
                    />
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Close
                  </button>
                  <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">
                    Create
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <h1>Create your Service</h1>
        <table class="table align-middle mb-0 bg-white">
          <thead class="bg-light">
            <tr>
              <th>Service Name</th>
              <th>Description</th>
              <th>Price</th>
              <th>Discount</th>
              <th>Duration</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="service in services.serviceOwner" :key="service.id">
              <td>
                <div class="d-flex align-items-center">
                  <img
                    :src="'http://127.0.0.1:8000' + service.image"
                    alt=""
                    style="width: 45px; height: 45px"
                    class="rounded-circle"
                  />
                  <div class="ms-3">
                    <p class="fw-bold mb-1">{{ service.service_name }}</p>
                  </div>
                </div>
              </td>
              <td>
                <p class="fw-normal mb-1">{{ service.description }}</p>
              </td>
              <td>
                <p class="fw-normal mb-1">{{ service.price }}</p>
              </td>
              <td>
                <p class="fw-normal mb-1">{{ service.discount }}</p>
              </td>
              <td>
                <p class="fw-normal mb-1">{{ service.duration }}</p>
              </td>
              <td>
                <button type="button" class="btn btn-primary">Edit</button>
                <button
                  type="button"
                  class="btn btn-danger btn-sm ml-3"
                  @click="deleteService(service.id)"
                >
                  Delete
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    {{ newService }}
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'
import { useServiceStore } from '../../../stores/service'
import { useCategoryStore } from '../../../stores/category'

const services = useServiceStore()
const categoryStore = useCategoryStore()

const newService = ref({
  image: '',
  service_name: '',
  description: '',
  price: '',
  duration: '',
  discount: '',
  category_id: null
})

const fetchServices = async () => {
  await services.getServiceOwner()
}

const fetchCategories = async () => {
  await categoryStore.getAllCategories()
}

// const handleFileUpload = (event) => {
//   const file = event.target.files[0]
//   newService.value.image = file
// }

const deleteService = async (id) => {
  await services.deleteserviceOwner(id)
  fetchServices()
}

const createServiceOwner = async () => {
  await services.createServiceOwner(newService.value)
  fetchServices()
  resetForm()
}

const resetForm = () => {
  newService.value = {
    service_name: '',
    description: '',
    price: '',
    discount: '',
    duration: '',
    category_id: null
    // image: null
  }
}

const openAddServiceModal = () => {
  resetForm()
}

onMounted(() => {
  fetchServices()
  fetchCategories()
})
</script>
