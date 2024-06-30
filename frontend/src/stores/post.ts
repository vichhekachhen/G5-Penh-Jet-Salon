import { defineStore } from 'pinia';
import { fetchAllPosts } from '@/api/post'; 

export const usePostStore = defineStore('posts', {
  state: () => ({
    posts: [] as Array<{ id: number, province_name: string }>,
  }),
  actions: {
    async getAllPosts() {
      try {
        const response = await fetchAllPosts(); // Call the API function to get all posts
        this.posts = response.data; 
      } catch (error) {
        console.error('Failed to fetch posts:', error);
      }
    },
  },
});
