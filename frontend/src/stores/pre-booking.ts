import { defineStore } from 'pinia';
import { fetchAllCardService, fetchAddCardService, deleteCardService } from '@/api/pre-booking';

export const useCardStore = defineStore('pre-booking', {
  state: () => ({
    cards: [],
  }),
  actions: {
    async fetchAllCards() {
      this.cards = await fetchAllCardService();
    },
    async addCard(id: number) {
      await fetchAddCardService(id);
      this.fetchAllCards();
    },
    async removeCard(id: number) {
      await deleteCardService(id);
      this.fetchAllCards();
    },
  },
});