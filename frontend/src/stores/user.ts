import { defineStore } from 'pinia'
// import axiosInstance from '@/plugins/axios'
import { registerCustomer, registerOwner, updateInfo } from '@/api/user'
import router from '@/router'

export const useUserStore = defineStore('user', {
  state: () => ({
    users: [],
    loading: false,
    error: null
  }),
  actions: {
    async createUser(userData:object) {
      try {
        const response = await registerOwner(userData)
        this.users = response.data
        router.router.push('/login')
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
