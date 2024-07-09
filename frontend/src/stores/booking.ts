import { defineStore } from 'pinia';
import { fetchBooking } from '@/api/booking';

export const useBookingStore = defineStore('booking', {
  state: () => ({
    bookings: [] as Booking[],
  }),
  actions: {
    async createBooking(formData: Booking) {
      try {
        const newBooking = await fetchBooking(formData);
        this.bookings.push(newBooking);
      } catch (error) {
        console.error('Error creating booking:', error);
      }
    },
  },
});

interface Booking {
  user_id: number;
  store_id: number;
  total_price: number;
  date: string;
  time: string;
  indebte: boolean;
  pay: boolean;
}

