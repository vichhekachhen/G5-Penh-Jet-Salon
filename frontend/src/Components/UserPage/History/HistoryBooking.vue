<template>
    <WebLayout>
      <div class="container mt-4 p-4 bg-white shadow rounded">
        <div class="text-center mb-4">
          <h3 class="text-pink-500"> History Booking</h3>
        </div>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Service Name</th>
                <th scope="col">Shop Name</th>
                <th scope="col">Date</th>
                <th scope="col">Time</th>
                <th scope="col">Price</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="post in store.posts" :key="post.id">
                <th scope="row"></th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </WebLayout>
  </template>
  
  <script>
  import WebLayout from '@/Components/Layouts/WebLayout.vue'
  import { usePostStore } from '@/stores/post-list'
  
  export default {
    name: 'PostList',
    components: {
      WebLayout
    },
    data() {
      return {
        store: usePostStore(),
      }
    },
    mounted() {
      this.fetchPosts()
    },
    methods: {
      fetchPosts() {
        this.store.getAllPosts()
      }
    }
  }
  </script>