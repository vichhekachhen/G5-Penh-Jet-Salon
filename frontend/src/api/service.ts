import http from './api'

export function fetchAllServiceOwner() {
  return http.get('/service/list')
}

export function fetchAllService(id:number) {
  return http.get(`/service/list/${id}`)
}
export function createservice(value:object) {
  return http.post('/service/create', value)
}
export function deleteservice(id:number) {
  return http.delete(`/service/destroy/${id}`)
}