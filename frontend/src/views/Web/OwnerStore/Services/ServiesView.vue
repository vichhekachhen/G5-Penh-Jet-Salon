<template>
  <div class="p-5">
    <div class="d-flex justify-content-end p-5">
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ServiceModal" @click="openAddServiceModal">
        + Add Service
      </button>
    </div>
    <!-- Modal create and update service-->
    <div class="modal fade" id="ServiceModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ServiceModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="ServiceModalLabel">{{ editMode ? 'Edit Service' : 'Add New Service' }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="formFile" class="form-label">Upload Image</label>
              <input class="form-control" type="file" id="formFile" @change="handleFileUpload">
            </div>
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
              <label for="serviceDiscount" class="form-label">Discount</label>
              <input type="number" class="form-control" id="serviceDiscount" v-model="newService.discount">
            </div>
            <div class="mb-3">
              <label for="serviceDuration" class="form-label">Duration</label>
              <input type="text" class="form-control" id="serviceDuration" v-model="newService.duration">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" @click="saveService">{{ editMode ? 'Update' : 'Create' }}</button>
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
              <img :src="service.image" alt="" style="width: 45px; height: 45px" class="rounded-circle" />
              <div class="ms-3">
                <p class="fw-bold mb-1">{{ service.name }}</p>
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
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ServiceModal" @click="openEditServiceModal(service)">Edit</button>
            <button type="button" class="btn btn-danger btn-sm ml-3" @click="deleteService(service.id)">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      services: [
        // { id: 1, name: "Service 1", description: "Description 1", price: 100, discount: 10, duration: "30m", image: "https://mdbootstrap.com/img/new/avatars/8.jpg" },
        // { id: 2, name: "Service 2", description: "Description 2", price: 200, discount: 20, duration: "60m", image: "https://mdbootstrap.com/img/new/avatars/8.jpg" },
        // { id: 3, name: "Service 3", description: "Description 3", price: 300, discount: 30, duration: "90m", image: "https://mdbootstrap.com/img/new/avatars/8.jpg" }
      ],
      newService: {
        image: '',
        name: '',
        description: '',
        price: '',
        discount: '0',
        duration: ''
      },
      editMode: false,
      editServiceId: null,
      imageData: null
    };
  },
  methods: {
    openAddServiceModal() {
      this.editMode = false;
      this.newService = {
        image: '',
        name: '',
        description: '',
        price: '',
        discount: '0',
        duration: ''
      };
    },
    openEditServiceModal(service) {
      this.editMode = true;
      this.newService = service;
      this.editServiceId = service.id;
      this.showModal('ServiceModal');
    },
    handleFileUpload(event) {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
          this.newService.image = e.target.result;
        };
        reader.readAsDataURL(file);
      }
    },
    saveService() {
      if (this.editMode) {
        const serviceIndex = this.services.findIndex(service => service.id === this.editServiceId);
        if (serviceIndex !== -1) {
          this.$set(this.services, serviceIndex, { ...this.newService, id: this.editServiceId });
        }
        this.editMode = false;
        this.editServiceId = null;
      } else {
        const newService = { ...this.newService, id: Date.now() };
        this.services.push(newService);
      }
      this.newService = {
        image: '',
        name: '',
        description: '',
        price: '',
        discount: '0',
        duration: ''
      };
    },
    deleteService(id) {
      this.services = this.services.filter(service => service.id !== id);
    },
  }
};

// import axios from 'axios';

// export default {
//   data() {
//     return {
//       services: [],
//       newService: {
//         name: '',
//         description: '',
//         price: '',
//         duration: ''
//       },
//       editMode: false,
//       editServiceId: null
//     }
//   },
  // created() {
  //   this.fetchServices();
  // },
  // methods: {
  //   async fetchServices() {
  //     try {
  //       const response = await axios.get('https://api.example.com/services');
  //       this.services = response.data;
  //     } catch (error) {
  //       console.error('Error fetching services:', error);
  //     }
  //   },
  //   async addService() {
  //     try {
  //       if (this.editMode) {
  //         await axios.put(`https://api.example.com/services/${this.editServiceId}`, this.newService);
  //         const serviceIndex = this.services.findIndex(service => service.id === this.editServiceId);
  //         this.$set(this.services, serviceIndex, { ...this.newService, id: this.editServiceId });
  //         this.editMode = false;
  //         this.editServiceId = null;
  //       } else {
  //         const response = await axios.post('https://api.example.com/services', this.newService);
  //         this.services.push(response.data);
  //       }
  //       this.newService = { name: '', description: '', price: '', duration: '' };
  //       this.$refs.staticBackdrop.hide();
  //     } catch (error) {
  //       console.error('Error adding/editing service:', error);
  //     }
  //   },
  //   async deleteService(id) {
  //     try {
  //       await axios.delete(`https://api.example.com/services/${id}`);
  //       this.services = this.services.filter(service => service.id !== id);
  //     } catch (error) {
  //       console.error('Error deleting service:', error);
  //     }
  //   },
  //   editService(service) {
  //     this.newService = { ...service };
  //     this.editMode = true;
  //     this.editServiceId = service.id;
  //     const modal = new bootstrap.Modal(document.getElementById('staticBackdrop'));
  //     modal.show();
  //   }
  // }
// }
</script>