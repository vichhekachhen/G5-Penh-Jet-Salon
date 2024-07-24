<template>
  <WebLayout>
    <div class="container mt-4 p-4 bg-white shadow rounded">
      <router-link to="/history" class="bg-pink-600 text-white p-2 rounded transition-colors duration-300 btn-sm">
        <i class="bi bi-arrow-left me-2"></i>
      </router-link>
      <div class="text-center mb-4">
        <h3 class="text-pink-500">Booking Detail</h3>
      </div>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th scope="col">Image</th>
              <th scope="col">Service Name</th>
              <th scope="col">Price</th>
              <th scope="col">Discount</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="booking in store.bookingList" :key="booking.id">
              <td></td>
              <td>
                <img class="w-10 h-10" :src="'http://127.0.0.1:8000' + booking.service_image" />
              </td>
              <td>{{ booking.service_name }}</td>
              <td>${{ booking.price }}</td>
              <td>${{ booking.discount }}</td>
              <td>
                <button class="btn btn-sm btn-primary" @click="addNewService(booking.service_id)">
                  <router-link to="/payment" class="text-white">
                    <i class="fas fa-edit">Booking again</i>
                  </router-link>
                </button>
              </td>
            </tr>
            {{bookingList}}
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
    fetchBookings() {
      useBooking.fetchAllBokkings();
    },
    fetchAllBookingListDetail() {
      const id = this.$route.params.id;
      useBooking.fetchAllBookingListDetail(id);
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