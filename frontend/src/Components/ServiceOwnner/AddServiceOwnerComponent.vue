<template>
  <div class="container">
    <div class="d-flex justify-content-end p-5">
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        +AddService
      </button>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <!-- Form inputs to add a new service -->
            <div class="mb-3">
              <label for="serviceName" class="form-label">Service Name</label>
              <input type="text" class="form-control" id="serviceName" v-model="newService.name">
            </div>
            <div class="mb-3">
              <label for="serviceDescription" class="form-label">Description</label>
              <input type="text" class="form-control" id="serviceDescription" v-model="newService.description">
            </div>
            <div class="mb-3">
              <label for="servicePrice" class="form-label">Price</label>
              <input type="number" class="form-control" id="servicePrice" v-model="newService.price">
            </div>
            <div class="mb-3">
              <label for="serviceDuration" class="form-label">Duration</label>
              <input type="text" class="form-control" id="serviceDuration" v-model="newService.duration">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" @click="addService">Save</button>
          </div>
        </div>
      </div>
    </div>
      
      <h1>Create Service</h1>
      <table class="table align-middle mb-0 bg-white">
        <thead class="bg-light">
        <tr>
          <th>ServiceName</th>
          <th>Description</th>
          <th>Price</th>
          <th>Duration</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <!-- <tr v-for="service in services" :key="service.id"> -->
        <tr>
          <td>
            <div class="d-flex align-items-center">
              <img src="https://mdbootstrap.com/img/new/avatars/8.jpg" alt="" style="width: 45px; height: 45px" class="rounded-circle" />
              <div class="ms-3">
                <p class="fw-bold mb-1">Veak</p>
                <!-- <p class="fw-bold mb-1">{{ service.name }}</p> -->
              </div>
            </div>
          </td>
          <td>
            <p class="fw-normal mb-1">Hello</p>
            <!-- <p class="fw-normal mb-1">{{ service.description }}</p> -->
          </td>
          <td>
            <p class="fw-normal mb-1">10$</p>
            <!-- <p class="fw-normal mb-1">{{ service.price }}</p> -->
          </td>
          <td>
            <p class="fw-normal mb-1">3m</p>
            <!-- <p class="fw-normal mb-1">{{ service.duration }}</p> -->
          </td>
          <td>
            <button type="button" class="btn btn-primary btn-sm">Edit</button>
            <button type="button" class="btn btn-danger btn-sm" @click="deleteService(service.id)">Delete</button>
          </td>
        </tr>
        </tbody>
      </table>
    </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      services: [],
      newService: {
        name: '',
        description: '',
        price: '',
        duration: ''
      }
    }
  },
  created() {
    this.fetchServices();
  },
  methods: {
    async fetchServices() {
      try {
        const response = await axios.get('https://api.example.com/services');
        this.services = response.data;
      } catch (error) {
        console.error('Error fetching services:', error);
      }
    },
    async addService() {
      try {
        const response = await axios.post('https://api.example.com/services', this.newService);
        this.services.push(response.data);
        this.newService = { name: '', description: '', price: '', duration: '' };
        this.$refs.shopModal.hide();
      } catch (error) {
        console.error('Error adding service:', error);
      }
    },
    async deleteService(id) {
      try {
        await axios.delete(`https://api.example.com/services/${id}`);
        this.services = this.services.filter(service => service.id !== id);
      } catch (error) {
        console.error('Error deleting service:', error);
      }
    }
  }
}
</script>
