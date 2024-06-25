import { defineStore } from 'pinia'
import axiosInstance from '@/plugins/axios'

export const useUserStore = defineStore('user', {
  state: () => ({
    users: [],
    user: {
      name: '',
      email: '',
      password: '',
      password_confirmation: '',
      city: '',
      shop_name: '',
      gender: '',
      province_id: '',
      shop_profile: ''
    },
    loading: false,
    error: null
  }),
  actions: {
    async createUser(userData: {
      name: string
      email: string
      password: string
      password_confirmation: string
      city: string
      shop_name: string
      gender: string
      province_id: string
      shop_profile: string
    }) {
      this.loading = true
      this.error = null
      try {
        const response = await axiosInstance.post('/registerOwner', userData)
        this.users = response.data
        this.user = { ...this.user, ...userData }
      } catch (error) {
        console.error('Error creating post:', error)
      } finally {
        this.loading = false
      }
    }

    //     async updateUser(userId, userData) {
    //       this.loading = true;
    //       this.error = null;
    //       try {
    //         const response = await axiosInstance.put(`/users/${userId}`, userData);
    //         const index = this.users.findIndex(user => user.id === userId);
    //         if (index !== -1) {
    //           this.users[index] = response.data;
    //         }
    //       } catch (error) {
    //         this.error = error.response ? error.response.data : error.message;
    //       } finally {
    //         this.loading = false;
    //       }
    //     },
    //     async deleteUser(userId) {
    //       this.loading = true;
    //       this.error = null;
    //       try {
    //         await axiosInstance.delete(`/users/${userId}`);
    //         this.users = this.users.filter(user => user.id !== userId);
    //       } catch (error) {
    //         this.error = error.response ? error.response.data : error.message;
    //       } finally {
    //         this.loading = false;
    //       }
    //     },
    //     async fetchUsers() {
    //       this.loading = true;
    //       this.error = null;
    //       try {
    //         const response = await axiosInstance.get('/users');
    //         this.users = response.data;
    //       } catch (error) {
    //         this.error = error.response ? error.response.data : error.message;
    //       } finally {
    //         this.loading = false;
    //       }
    //     },
  }
})
