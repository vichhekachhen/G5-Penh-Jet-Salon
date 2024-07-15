<template>
  <WebLayout>
    <div class="container mt-4 p-4 bg-white shadow rounded">
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
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="booking in store.bookings" :key="booking.id">
              <th scope="row">{{ booking.id }}</th>
              <td>{{ booking.shop_name }}</td>
              <td>{{ booking.date }}</td>
              <td>{{ booking.time }}</td>
              <td>{{ booking.total_price }}</td>
              <td class="text-blue" data-bs-toggle="modal" data-bs-target="#exampleModal" @click="listDetail(booking.id)">Details</td>
            </tr>
          </tbody>
        </table>
      </div>

    </div>
    <!-- {{ store.bookings }} -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog">
        <div class="modal-content" style="width: 120vh; margin:20px;">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Booking Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div>
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">Shop Name</th>
                      <th scope="col">Service Name</th>
                      <th scope="col">Description</th>
                      <th scope="col">Pricie</th>
                      <th scope="col">Duration</th>
                      <th scope="col">Discount</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
          </div>
        </div>
      </div>
    </div>
  </WebLayout>
</template>

<script>
import WebLayout from '@/Components/Layouts/WebLayout.vue';
import { useBookingStore } from '../../../stores/booking'; // Ensure this path is correct
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
    this.fetchBookings(); // Fetch all bookings on mount
  },
  methods: {
    fetchBookings(){
      useBooking.fetchAllBokkings(); 
    },
  }
};
</script>
