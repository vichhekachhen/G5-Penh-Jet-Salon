<template>
  <div>
    <v-toolbar extended light>
      <template v-slot:extension>
        <v-fab
          color="cyan-accent-2"
          icon="mdi-plus"
          size="50"
          absolute
          @click="dialog = !dialog"
        ></v-fab>
      </template>
    </v-toolbar>

    <v-card class="my-2">
      <v-dialog v-model="dialog" max-width="400">
        <v-card>
          <v-card-text>
            <v-text-field v-model="service.name" label="Name service"></v-text-field>
            <v-text-field v-model="service.description" label="Description"></v-text-field>
            <v-text-field v-model="service.price" label="Price" type="number"></v-text-field>
            <v-text-field v-model="service.duration" label="Duration" type="number"></v-text-field>
            <v-text-field v-model="service.discount" label="Discount" type="number"></v-text-field>
            <v-select
              v-model="service.category"
              :items="categories"
              label="Category"
              item-text="name"
              item-value="id"
            ></v-select>
          </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary" variant="text" @click="submitService">
              Submit
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-card>
    {{ fetchCategories }}
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axiosInstance from '@/plugins/axios';

const dialog = ref(false);

const service = ref({
  name: '',
  description: '',
  price: '',
  duration: '',
  discount: '',
  category: '', // Added category to the service object
});

const desserts = ref([]);
const categories = ref([]);

const createServices = async () => {
  try {
    const response = await axiosInstance.get('/service/list');
    desserts.value = response.data.data;
  } catch (error) {
    console.error('Error fetching services:', error.message);
  }
};

const fetchCategories = async () => {
  try {
    const response = await axiosInstance.get('/category/list');
    categories.value = response.data.data;
  } catch (error) {
    console.error('Error fetching categories:', error.message);
  }
};

const submitService = async () => {
  try {
    const response = await axiosInstance.post('/service/create');
    desserts.value.push(response.data.data);
    console.log('Service created:', response.data.data);
    dialog.value = false; // Close the dialog after submission
    resetServiceForm(); // Reset the form fields after submission
  } catch (error) {
    console.error('Error creating service:', error.message);
  }
};

const resetServiceForm = () => {
  service.value = {
    name: '',
    description: '',
    price: '',
    duration: '',
    discount: '',
    category: '',
  };
};

onMounted(() => {
  createServices();
  fetchCategories();
});
</script>
