import http from './api'

export function store(values: object) {
  return http.post('/booking', values)
}
export function fetchAllBooking() {
  return http.get('/booking/list')
}
export function fetchAllBookingListDetail(id:number) {
  return http.get(`/booking/list/detail/${id}`)
}


