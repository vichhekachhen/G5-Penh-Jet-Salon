import http from './api'

export function store(values: object) {
  return http.post('/booking', values)
}


