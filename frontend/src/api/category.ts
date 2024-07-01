import http from './api'

export function fetchAllCategory() {
  return http.get('/category/list')
}
