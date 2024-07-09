import http from './api';

export function fetchBooking() {
  return http.post('/booking');
}

