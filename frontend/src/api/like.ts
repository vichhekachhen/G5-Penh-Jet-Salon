import http from './api'

export function fetchAllLikes() {
  return http.post('/like-service/{service_id}')
}

export function addFavorite(id:number) {
  return http.post(`like-service/${id}`)
}