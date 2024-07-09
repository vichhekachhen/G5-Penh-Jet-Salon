import { defineStore } from 'pinia';
import { Booking, CardItem } from '@/api/booking';

export const useBookingStore = defineStore('bookingStore', {
  state: () => ({
    booking: null as Booking | null,
    preBookings: [] as CardItem[],
    totalPrice: 0,
    storeId: null as string | null,
  }),
  actions: {
    async createBooking(bookingData: { date: string; time: string; pay: number; indebte: number }) {
      try {
        const user = await this.getCurrentUser();
        if (this.preBookings.length <= 0) {
          return { success: false, message: 'Don\'t have pre_booking' };
        }

        const booking = await this.createBookingRecord(bookingData, user);

        await this.processPreBookings(booking);

        // Update the booking with store_id and total_price
        booking.store_id = this.storeId;
        booking.total_price = this.totalPrice;
        await booking.save();

        // Refresh the booking model instance to reflect changes made in database
        await booking.refresh();

        this.booking = booking;
        return { success: true, message: 'Booking successfully created!', result: booking };
      } catch (error) {
        console.error('Error creating booking:', error);
        return { success: false, message: 'Error creating booking' };
      }
    },
  },
});