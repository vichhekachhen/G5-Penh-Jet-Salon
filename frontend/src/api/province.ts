import http from './api'

export function fetchAllProvince() {
  return http.get('/province/list')
}
