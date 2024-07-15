
import { fetchAllStore } from '@/api/store';
import { defineStore } from 'pinia'

export const useSalonStore = defineStore('store', {
  state: () => ({
    stores: [],
  }),
  actions: {
    async getAllStores(id:number) {
      try {
        const response = await fetchAllStore(id);
        this.stores = response.data.data; 
        
      } catch (error) {
        console.error('Failed to fetch posts:', error);
      }
    },
}
})