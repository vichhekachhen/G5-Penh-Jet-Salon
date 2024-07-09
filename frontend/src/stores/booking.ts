import { defineStore } from 'pinia';
import { store } from '@/api/booking';

export const useBookingStore = defineStore('booking', {
  state: () => ({
    bookings: [],
  }),
  actions: {
    async createBooking(formData: object) {
      try {
        const newBooking = await store(formData);
        this.bookings.push(newBooking);
      } catch (error) {
        console.error('Error creating booking:', error);
      }
    },
  },
});


