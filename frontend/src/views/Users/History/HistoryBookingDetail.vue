<template>
  <WebLayout>
    <div class="container mt-4 p-4 bg-white shadow rounded">
      <div class="text-center mb-4">
        <h3 class="text-gray-500">History Services used for booking</h3>
      </div>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Image</th>
              <th scope="col">Service Name</th>
              <th scope="col">Price</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="booking in store.bookingList" :key="booking.id">
              <td>
                <img
                    class="w-9"
                    :src="'http://127.0.0.1:8000' + booking.service_image"
                />
              </td>
              <td>{{ booking.service_name }}</td>
              <td class="text-red">$ {{ booking.discount }}</td>
              <td>
                <button class="btn btn-sm btn-primary" @click="addNewService(booking.service_id)">
                  <router-link to="/payment" class="text-white text-white link-underline">
                    <i class="fas fa-edit">Booking again</i>
                  </router-link>
                </button>
                <button @click="deleteBooking(booking.id)" class="btn btn-sm btn-danger ml-3">
                  <i class="fas fa-trash-alt">Delete</i>
                </button>
              </td>
            </tr>
            <!-- {{store.bookingList}} -->
          </tbody>
        </table>
      </div>
    </div>
  </WebLayout>
</template>

<script>
import WebLayout from '@/Components/Layouts/WebLayout.vue';
import { useBookingStore } from '@/stores/booking'; // Ensure this path is correct
import { useAuthStore } from '@/stores/auth-store'
import { useRoute } from 'vue-router';
import { useCardStore } from '../../../stores/pre-booking';
const useBooking = useBookingStore();
const route = useRoute()
const cardItems = useCardStore();

export default {
    name: 'BookingList',
    components: {
        WebLayout
    },
    data() {
        return {
        store: useBookingStore(),
        storeId: useAuthStore()
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
            this.fetchAllBookingListDetail();
        },
        addNewService(service_id) {
          const user_id = this.storeId.user.id;
            this.service_id = service_id,
            this.user_id = user_id,
          cardItems.addCard(service_id, user_id);
        },
    },
    created() {
        this.fetchAllBookingListDetail();
    },
};
</script>