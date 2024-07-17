import http from './api'

export function fetchAllLikes(id:number) {
  return http.get(`/like/list/${id}`)
}

export function addFavorite(id:number) {
  return http.post(`/like-service/${id}`)
}

export function getIsFavorite(id:number) {
  return http.get(`/like/isFav/${id}`)
}