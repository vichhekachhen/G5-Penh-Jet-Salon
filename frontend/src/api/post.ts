import http from './api'
// http = http://127.0.0.1:8000/api

export function fetchAllPosts() {
  return http.get('/post/list')
}
export function deletePost() {
  return http.delete('/post/delete')
}

//run
// export function fetchAllService() {
//   return http.get('/service/list')
// }
