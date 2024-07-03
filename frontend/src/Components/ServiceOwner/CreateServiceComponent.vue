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
      <v-dialog v-model="dialog" max-width="800">
        <v-card>
          <form @submit.prevent="submitService">
            <v-card-text>
              <!-- <b>File image</b>
              <v-file-input
                accept=""
                label="File input"
                v-model="service.image"
                
              ></v-file-input> -->
              <b>Name service</b>
              <v-text-field v-model="service.service_name" label="Name service"></v-text-field>
              <b>Description</b>
              <v-text-field v-model="service.description" label="Description"></v-text-field>
              <b>Price</b>
              <v-text-field v-model="service.price" label="Price" type="number"></v-text-field>
              <b>Duration</b>
              <v-text-field v-model="service.duration" label="Duration" type="number"></v-text-field>
              <b>Discount</b>
              <v-text-field v-model="service.discount" label="Discount" type="number"></v-text-field>
              <el-form-item :error="categoryError">
                <b>Select a category</b>
                <select
                  class="form-select"
                  aria-label="Default select example"
                  v-model="service.category_id"
                  v-if="!isLoading && !error"
                >
                  <option
                    v-for="category in categoryStore.categories" :key="category.id"
                    :value="category.id"
                  >
                    {{ category.name }}
                  </option>
                </select>
                <div v-if="isLoading">Loading...</div>
                <div v-if="error">{{ error }}</div>
              </el-form-item>

            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="primary" @click="dialog = false" variant="text" type="submit">
                Submit
              </v-btn>
            </v-card-actions>
          </form>
        </v-card>
      </v-dialog>
    </v-card>
    
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';
import {useCategoryStore} from '../../stores/category'
import {useServiceStore} from '../../stores/service'
const serviceStore = useServiceStore();
const categoryStore = useCategoryStore();
const dialog = ref(false);
const isLoading = ref(false);
const error = ref(null);

const service = ref({
  // image: null,
  service_name: '',
  description: '',
  price: '',
  duration: '',
  discount: '',
  category_id: null,
});


const fetchCategories = async () => {
  try {
    isLoading.value = true;
    await categoryStore.getAllCategories();
  } catch (err) {
    error.value = 'Failed to load categories';
  } finally {
    isLoading.value = false;
  }
};

const submitService = async () => {
  serviceStore.createServiceOwner(service.value);
  fetchCategories();
  service.value = {
    // image: null,
    service_name: '',
    description: '',
    price: '',
    duration: '',
    discount: '',
    category_id: null,
  };
};

onMounted(() => {
  fetchCategories();
});
</script>
