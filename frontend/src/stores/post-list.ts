import { defineStore } from 'pinia'
import { fetchAllPosts } from '@/api/post';

export const usePostStore = defineStore('post', {
  state: () => ({
    posts: [] as Array<{ id: number; title: string; description: string }>
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
    
    // async createPost(postData: { title: string; description: string }) {
    //   try {
    //     const response = await axiosInstance.post('/post/create', postData, {
    //       headers: {
    //         Authorization: `Bearer ${localStorage.getItem('access_token')}`
    //       }
    //     })
    //     this.posts.push(response.data)
    //   } catch (error) {
    //     console.error('Error creating post:', error)
    //   }
    // },

    // async updatePost(postId: number, postData: { title: string; description: string }) {
    //   try {
    //     const response = await axiosInstance.put(`/post/update/${postId}`, postData, {
    //       headers: {
    //         Authorization: `Bearer ${localStorage.getItem('access_token')}`
    //       }
    //     })
    //     const index = this.posts.findIndex((post) => post.id === postId)
    //     if (index !== -1) {
    //       this.posts[index] = response.data
    //     }
    //   } catch (error) {
    //     console.error('Error updating post:', error)
    //   }
    // },

    // async deletePost(postId: number) {
    //   try {
    //     await axiosInstance.delete(`/post/delete/${postId}`, {
    //       headers: {
    //         Authorization: `Bearer ${localStorage.getItem('access_token')}`
    //       }
    //     })
    //     this.posts = this.posts.filter((post) => post.id !== postId)
    //   } catch (error) {
    //     console.error('Error deleting post:', error)
    //   }
    // }
  }
})
