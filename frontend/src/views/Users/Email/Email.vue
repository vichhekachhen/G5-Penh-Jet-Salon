<template>
  <div class="container">
    <h1>Send Email</h1>
    <div class="col-md-5 shadow p-3">
      <form @submit.prevent="submitSend">
        <label>Email</label>
        <input type="email" v-model="form.email" class="form-control mb-3" />
        <label>Message</label>
        <textarea v-model="form.content" class="form-control mb-3"></textarea>
        <button type="submit" class="btn btn-info">Send</button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';
import {notify } from '@kyvg/vue3-notification'; 
import { useAuthStore } from '@/stores/auth-store';

const useAuth = useAuthStore();

const form = ref({
  email: '',
  content: '',
});

const submitSend = async () => {
  await useAuth.getToken();
  await axios.post('/api/send-email', {
      email: form.value.email,
      content: form.value.content,
    })
    .then(responsive => {
      notify({
        title: response.data.message,
        type: "success",
      })
    }).catch (error =>{
      notify({
        title: error.response.data.message,
        type: "error",
      })
    })
  }
</script>