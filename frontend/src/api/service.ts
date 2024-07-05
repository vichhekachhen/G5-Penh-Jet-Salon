import http from './api'

export function fetchAllServiceOwner() {
  return http.get('/service/list')
}

export function fetchAllService(id:number) {
  return http.get(`/service/list/${id}`)
}
export function createservice(value:object) {
  return http.post('/service/create', value,{
    headers: { 'Content-Type': 'multipart/form-data'}
  })
}
export function deleteservice(id:number) {
  return http.delete(`/service/destroy/${id}`)
}
export function updateservice(id:number, value:object) {
  return http.post(`/service/update/${id}`,value,{
    headers: { 'Content-Type': 'multipart/form-data'}
  })
}
export function showService(id:number) {
  return http.get(`/service/show/${id}`)
}