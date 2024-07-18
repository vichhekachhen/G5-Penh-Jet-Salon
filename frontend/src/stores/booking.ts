import { defineStore } from 'pinia';
import { deleteBooking, deleteBookingShop, fetchAllBooking, fetchAllBookingListDetail, store } from '@/api/booking';

export const useBookingStore = defineStore('booking', {
  state: () => ({
    bookings: [],
    bookingList:[]
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
    async fetchAllBokkings() {
      try {
        const bookings = await fetchAllBooking();
        this.bookings = bookings.data.data
      } catch (error) {
        console.error('Error creating booking:', error);
      }
    },
    async fetchAllBookingListDetail(id:number){
      try {
        const bookingList = await fetchAllBookingListDetail(id);
        this.bookingList = bookingList.data.data
      } catch (error) {
        console.error('Error creating booking:', error);
      }
    },
    async deleteBooking(id:number){
      try {
        const bookingList = await deleteBooking(id);
        this.bookingList = bookingList.data.data
      } catch (error) {
        console.error('Error creating booking:', error);
      }
    },
    async deleteBookingShop(id:number){
      try {
        const bookings = await deleteBookingShop(id);
        this.bookings = bookings.data.data
      } catch (error) {
        console.error('Error creating booking:', error);
      }
    },
  },
});


