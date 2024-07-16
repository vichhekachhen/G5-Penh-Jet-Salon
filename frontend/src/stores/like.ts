import { defineStore } from 'pinia'
import { addFavorite } from '@/api/like';


export const useLikeStore = defineStore('like', {
  state: () => ({
    likedServices: []
  }),
  actions: {
    async addToFav(service_id:number) {
      try {
        const response = await addFavorite(service_id);
        this.likedServices = response.data.data; 
        console.log(response.data.data);
        
      } catch (error) {
        console.error('Failed to fetch likes:', error);
      } 
    },
  }
})