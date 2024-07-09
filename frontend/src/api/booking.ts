import axios from 'axios';

export async function fetchBooking(formData: Booking) {
  try {
    const response = await axios.post('/api/booking', formData);
    return response.data.result;
  } catch (error) {
    console.error('Error creating booking:', error);
    throw error;
  }
}

interface Booking {
  user_id: number;
  store_id: number;
  total_price: number;
  date: string;
  time: string;
  indebte: boolean;
  pay: boolean;
}

