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
            <tr v-for="(booking, index) in paginatedBookings" :key="booking.id">
              <th scope="row">{{ booking.id }}</th>
              <td>{{ booking.shop_name }}</td>
              <td>{{ booking.date }}</td>
              <td>{{ booking.time }}</td>
              <td>${{ booking.total_price }}</td>
              <td>
                <router-link :to="{ name: 'bookingDetail', params: { id: booking.id } }">
                  <button class="btn btn-sm btn-primary">
                    <i class="fas fa-edit"></i> Detail
                  </button>
                </router-link>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <nav v-if="totalPages > 1">
        <ul class="pagination justify-content-center">
          <li class="page-item" :class="{ disabled: currentPage === 1 }">
            <button class="page-link" @click="prevPage">&laquo;</button>
          </li>
          <li class="page-item" v-for="page in totalPages" :key="page" :class="{ active: currentPage === page }">
            <button class="page-link" @click="changePage(page)">{{ page }}</button>
          </li>
          <li class="page-item" :class="{ disabled: currentPage === totalPages }">
            <button class="page-link" @click="nextPage">&raquo;</button>
          </li>
        </ul>
      </nav>
    </div>
  </WebLayout>
</template>

<script>
import WebLayout from '@/Components/Layouts/WebLayout.vue';
import { useBookingStore } from '@/stores/booking'; // Import your Vuex store

export default {
  name: 'BookingList',
  components: {
    WebLayout
  },
  data() {
    return {
      currentPage: 1,
      bookingsPerPage: 10,
    };
  },
  computed: {
    store() {
      return useBookingStore();
    },
    totalBookings() {
      return this.store.bookings.length;
    },
    totalPages() {
      return Math.ceil(this.totalBookings / this.bookingsPerPage);
    },
    paginatedBookings() {
      const startIndex = (this.currentPage - 1) * this.bookingsPerPage;
      return this.store.bookings.slice(startIndex, startIndex + this.bookingsPerPage);
    }
  },
  mounted() {
    this.fetchBookings();
  },
  methods: {
    fetchBookings() {
      this.store.fetchAllBokkings(); // Dispatch action to fetch bookings
    },
    deleteBookingShop(id) {
      this.store.dispatch('deleteBookingShop', id); // Dispatch action to delete booking
      this.fetchBookings(); // Refresh bookings after delete
    },
    changePage(page) {
      this.currentPage = page;
    },
    nextPage() {
      if (this.currentPage < this.totalPages) {
        this.currentPage++;
      }
    },
    prevPage() {
      if (this.currentPage > 1) {
        this.currentPage--;
      }
    }
  }
};
</script>

<style>
/* Add your custom styles here */
</style>
