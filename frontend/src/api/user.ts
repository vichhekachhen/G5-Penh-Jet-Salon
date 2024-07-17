import http from './api'

export function registerOwner(value:object) {
  return http.post('/registerOwner',value)
}

export function registerCustomer(value:object) {
  return http.post('/register',value)
}

export function updateInfo(value:object) {
  return http.put('/updateInfo',value)
}

export function addInfoOwner(value:object) {
  return http.post('/update/infoOwner',value,{
    headers: { 'Content-Type': 'multipart/form-data'}
  })
}