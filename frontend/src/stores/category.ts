
import { fetchAllCategory } from '@/api/category';
import { defineStore } from 'pinia'

export const useCategoryStore = defineStore('category', {
  state: () => ({
    categories: [],
  }),
  actions: {
    async getAllCategories() {
      try {
        const response = await fetchAllCategory();
        this.categories = response.data.data; 
      } catch (error) {
        console.error('Failed to fetch posts:', error);
      }
    },
}
})