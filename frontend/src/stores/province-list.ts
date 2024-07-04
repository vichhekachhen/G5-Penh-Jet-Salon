import { defineStore } from 'pinia';
import { fetchAllProvince } from '@/api/province';

export const useProvinceStore = defineStore('province', {
  state: () => ({
    provinces: [] as Array<{ id: number, province_name: string }>,
    isLoading: false,
    error: null as string | null
  }),
  actions: {
    async fetchProvinces() {
      this.isLoading = true;
      this.error = null;
      try {
        const response = await fetchAllProvince()
        this.provinces = response.data.data;
        
      } catch (error) {
        console.error('Error fetching provinces:', error);
        this.error = 'Failed to load provinces';
      } finally {
        this.isLoading = false;
      }
    },
  }
});
