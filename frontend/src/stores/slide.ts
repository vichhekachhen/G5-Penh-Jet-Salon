
import { defineStore } from 'pinia'
import { fetchAllSlide } from '@/api/slide';

export const useSlideStore = defineStore('slide', {
  state: () => ({
    slides: [],
  }),
  actions: {
    async getAllSlide() {
      try {
        const response = await fetchAllSlide();
        this.slides = response.data.data; 
      } catch (error) {
        console.error('Failed to fetch posts:', error);
      }
    },
}
})