import http from './api'

export function fetchAllSlide() {
  return http.get('/slideshow/list')
}