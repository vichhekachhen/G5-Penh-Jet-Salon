import http from './api'
export function sentMail(email: object) {
  return http.post('/send-email', email)
}
