import http from './api'

export function registerOwner(value:object) {
  return http.post('/registerOwner',value)
}

export function registerCustomer(value:object) {
  return http.post('/register',value)
}
