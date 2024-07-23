import http from './api'
export function sentMail(email: string) {
  return http.post('/send-email', email)
}


