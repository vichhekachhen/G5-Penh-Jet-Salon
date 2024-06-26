import { defineStore } from 'pinia';
import axiosInstance from '@/plugins/axios';

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
        const response = await axiosInstance.get('/province/list');
        this.provinces = response.data.data;
        // console.log(response.data.data);
      } catch (error) {
        console.error('Error fetching provinces:', error);
        this.error = 'Failed to load provinces';
      } finally {
        this.isLoading = false;
      }
    },

  }
});
