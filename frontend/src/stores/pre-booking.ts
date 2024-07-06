import { defineStore } from 'pinia';
import { fetchAllCardService, fetchAddCardService, deleteCardService } from '@/api/pre-booking';

export const useCardStore = defineStore('pre-booking', {
  state: () => ({
    cards: [],
  }),
  actions: {
    async fetchAllCards() {
      await fetchAllCardService();
    },
    async addCard(id: number) {
      try {
        const response = await fetchAddCardService(id)
        this.cards = response.data.data; 
      } catch (error) {
        console.error('Failed to fetch posts:', error);
      }
    },
    async removeCard(id: number) {
      await deleteCardService(id);
      this.fetchAllCards();
    },
  },
});