<template>
  <WebLayout>
    <div class="container mt-4 p-4 bg-white shadow rounded">
      <div class="text-center mb-4">
        <h3 class="text-gray-500">History Services used for booking</h3>
      </div>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Service Name</th>
              <th scope="col">Price</th>
              <th scope="col">Data</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="booking in store.bookingList" :key="booking.id">
              <th scope="row">{{ booking.id }}</th>
              <td>{{ booking.service_name }}</td>
              <td>${{ booking.discount }}</td>
              <td>{{ booking.created_at }}</td>
              <td>
                <router-link to="/bookingDetail">
                <router-link to="/payment">
                  <button class="btn btn-sm btn-primary">
                    <i class="fas fa-edit">Booking again</i>
                  </button>
                </router-link>
                </router-link>
                <button @click="deleteBooking(booking.id)" class="btn btn-sm btn-danger ml-3">
                  <i class="fas fa-trash-alt">Delete</i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- {{store.bookingList}} -->
    </div>
  </WebLayout>
</template>

<script>
import WebLayout from '@/Components/Layouts/WebLayout.vue';
import { useBookingStore } from '@/stores/booking'; // Ensure this path is correct
import { useRoute } from 'vue-router';
const useBooking = useBookingStore();
const route = useRoute()

export default {
    name: 'BookingList',
    components: {
        WebLayout
    },
    data() {
        return {
        store: useBookingStore(),
        };
    },
    mounted() {
        this.fetchBookings();
    },
    methods: {
        fetchBookings(){
            useBooking.fetchAllBokkings();
        },
        fetchAllBookingListDetail() {
        const id = this.$route.params.id;
            useBooking.fetchAllBookingListDetail(id);
        },
        deleteBooking(id) {
            useBooking.deleteBooking(id);
        },
    },
    created() {
        this.fetchAllBookingListDetail();
    }
};
</script>
