<template>
  <WebLayout>
    <div class="container mt-4 p-4 bg-white shadow rounded">
      <router-link to="/" class="bg-pink-500 text-white p-2 rounded transition-colors duration-300 btn-sm">
          <i class="bi bi-arrow-left me-2"></i>
      </router-link>
      <div class="text-center mb-4">
        <h3 class="text-pink-500">History Booking</h3>
      </div>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Shop Name</th>
              <th scope="col">Date</th>
              <th scope="col">Time</th>
              <th scope="col">Price</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="booking in store.bookings" :key="booking.id">
              <th scope="row">{{ booking.id }}</th>
              <td>{{ booking.shop_name }}</td>
              <td>{{ booking.date }}</td>
              <td>{{ booking.time }}</td>
              <td>${{ booking.total_price }}</td>
              <td>
                <router-link :to="{ name: 'bookingDetail', params: { id: booking.id } }">
                  <button class="btn btn-sm btn-primary">
                    <i class="fas fa-edit">Detail</i>
                  </button>
                </router-link>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </WebLayout>
</template>

<script>
import WebLayout from '@/Components/Layouts/WebLayout.vue';
import { useBookingStore } from '@/stores/booking';
const useBooking = useBookingStore();

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
    fetchBookings() {
      useBooking.fetchAllBokkings();
    },
    deleteBookingShop(id) {
      useBooking.deleteBookingShop(id);
      this.fetchBookings();
    }
  }
};
</script>
