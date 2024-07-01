<template>
  <div class="app">
    <SideBarVue></SideBarVue>
    <div class="d-flex justify-content-end">
      <div class="p-5 w-300">
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
                <h5 class="modal-title" id="ServiceModalLabel">
                  {{ editMode ? 'Edit Service' : 'Add New Service' }}
                </h5>
                <button
                  type="button"
                  class="btn-close"
                  data-bs-dismiss="modal"
                  aria-label="Close"
                ></button>
              </div>
              <div class="modal-body">
                <div class="mb-3">
                  <label for="formFile" class="form-label">Upload Image</label>
                  <input
                    class="form-control"
                    type="file"
                    id="formFile"
                    @change="handleFileUpload"
                  />
                </div>
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
                    type="text"
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
                <button
                  type="button"
                  class="btn btn-primary"
                  data-bs-dismiss="modal"
                  @click="handleSubmit"
                >
                  {{ editMode ? 'Update' : 'Create' }}
                </button>
              </div>
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
            <tr v-for="service in services" :key="service.id">
              <td>
                <div class="d-flex align-items-center">
                  <img
                    :src="'http://127.0.0.1:8000'+ service.image"
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
                <button
                  type="button"
                  class="btn btn-primary"
                  data-bs-toggle="modal"
                  data-bs-target="#ServiceModal"
                  @click="openEditServiceModal(service)"
                >
                  Edit
                </button>
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
        {{services}}
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'
import SideBarVue from '../Web/OwnerStore/SideBar.vue'
import axiosInstance from '@/plugins/axios'

const services = ref([])
const newService = ref({
  service_name: '',
  description: '',
  price: '',
  discount: '',
  duration: '',
  image: ''
})
const editMode = ref(false)
const currentServiceId = ref(null)

const fetchServices = async () => {
  const response = await axiosInstance.get('/service/list')
  services.value = response.data
}

const handleFileUpload = (event) => {
  const file = event.target.files[0]
  newService.value.image = file
}

const handleSubmit = async () => {
  const formData = new FormData()
  formData.append('service_name', newService.value.service_name)
  formData.append('description', newService.value.description)
  formData.append('price', newService.value.price)
  formData.append('discount', newService.value.discount)
  formData.append('duration', newService.value.duration)
  formData.append('image', newService.value.image)

  if (editMode.value) {
    await axiosInstance.put(`/service/update/${currentServiceId.value}/`, formData)
  } else {
    await axiosInstance.post('/service/create/', formData)
  }

  fetchServices()
  resetForm()
}

const openAddServiceModal = () => {
  editMode.value = false
  resetForm()
}

const openEditServiceModal = (service) => {
  editMode.value = true
  currentServiceId.value = service.id
  newService.value.service_name = service.service_name
  newService.value.description = service.description
  newService.value.price = service.price
  newService.value.discount = service.discount
  newService.value.duration = service.duration
  newService.value.image = service.image
}

const deleteService = async (id) => {
  await axiosInstance.delete(`/service/destroy/${id}/`)
  fetchServices()
}

const resetForm = () => {
  newService.value.service_name = ''
  newService.value.description = ''
  newService.value.price = ''
  newService.value.discount = ''
  newService.value.duration = ''
  newService.value.image = ''
}

onMounted(() => {
  fetchServices()
})
</script>
