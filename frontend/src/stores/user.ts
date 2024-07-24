import { defineStore } from 'pinia'
import { addInfoOwner, registerCustomer, registerOwner, updateInfo } from '@/api/user'
import router from '@/router'

export const useUserStore = defineStore('user', {
  state: () => ({
    users: [],
    loading: false,
    error: null
  }),
  actions: {
    async createUserOwner(userData:object) {
      try {
        const response = await registerOwner(userData)
        this.users = response.data
        localStorage.setItem('access_token', response.data.access_token)
        router.router.push('/infoDetail')
      } catch (error) {
        console.error('Error creating user:', error)
      } finally {
        this.loading = false
      }
    },
    async createUserCustomer(userData:object) {
      try {
        const response = await registerCustomer(userData)
        this.users = response.data
        router.router.push('/login')
      } catch (error) {
        console.error('Error creating user:', error)
      } finally {
        this.loading = false
      }
    },
    async updateUserInfo(userData:object) {
      try {
        const response = await updateInfo(userData)
        this.users = response.data
        router.router.push('/profile')
      } catch (error) {
        console.error('Error updating user:', error)
      } finally {
        this.loading = false
      }
    },


    async addInfoToOwner(userData:object) {
      try {
        const response = await addInfoOwner(userData)
        this.users = response.data
        router.router.push('/login')
      } catch (error) {
        console.error('Error updating user:', error)
      } finally {
        this.loading = false
      }
    },
  }
})
