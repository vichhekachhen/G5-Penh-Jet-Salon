import { defineStore } from 'pinia';
import { Booking, CardItem, Service, BookingService, auth } from '@/api/booking';

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
    async getCurrentUser() {
      // Fetch the current user from the authentication system
      return await auth.currentUser();
    },
    async createBookingRecord(bookingData: { date: string; time: string; pay: number; indebte: number }, user: { id: string }) {
      // Create a new booking record
      return await Booking.create({
        user_id: user.id,
        store_id: null,
        total_price: 0,
        date: bookingData.date,
        time: bookingData.time,
        pay: bookingData.pay,
        indebte: bookingData.indebte,
      });
    },
    async processPreBookings(booking: Booking) {
      // Process the pre-bookings and update the store state
      this.preBookings = await CardItem.where('user_id', booking.user_id).get();

      for (const preBooking of this.preBookings) {
        // Prevent deletion of pre-bookings for this user
        if (booking) {
          await preBooking.delete();
        }

        const service = await Service.find(preBooking.service_id);
        if (service) {
          this.storeId = service.store_id;
          this.totalPrice += service.price;
          await BookingService.create({
            booking_id: booking.id,
            service_id: preBooking.service_id,
          });
        }
      }
    },
  },
});