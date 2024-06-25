import { defineStore } from 'pinia';
import axios from 'axios';

export const useUserStore = defineStore('user', {
  state: () => ({
    users: [] as Array<{ id: number, name: string, email: string, profile: string }>
  }),
  actions: {
    setUsers(users: Array<{ id: number, name: string, email: string, profile: string }>) {
      this.users = users;
    },
    async fetchUsers() {
      try {
        const response = await axios.get('/api/users');
        this.setUsers(response.data);
      } catch (error) {
        console.error('Error fetching users:', error);
      }
    }
  }
});