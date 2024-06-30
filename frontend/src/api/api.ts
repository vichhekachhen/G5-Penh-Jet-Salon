import axios from 'axios'
// VITE_BASE_URL=http://127.0.0.1:8000/api
const api = axios.create({
  baseURL: import.meta.env.VITE_BASE_URL,
  headers: {
    'Content-Type': 'application/json'
  }
})
// Add a request interceptor
api.interceptors.request.use(
  (config) => {
    const token = localStorage.getItem('access_token')
    if (token) {
        console.log(token);
        
      config.headers.Authorization = `Bearer ${token}`
    }
    return config
  },
  (error) => {
    return Promise.reject(error)
  }
)

// Add a response interceptor
api.interceptors.response.use(
  (response) => response,
  (error) => {
    // Handle error
    if (error.response.status === 401) {
      // Handle unauthorized access, e.g., redirect to login
    }
    return Promise.reject(error)
  }
)

export default api
