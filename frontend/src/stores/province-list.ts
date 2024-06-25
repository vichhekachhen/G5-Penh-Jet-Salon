import { defineStore } from 'pinia';
import axiosInstance from '@/plugins/axios';

export const useProvinceStore = defineStore('province', {
  state: () => ({
    provinces: [] as Array<{ id: number, province_name: string }>
  }),
  actions: {
    async fetchProvinces() {
      try {
        const response = await axiosInstance.get('/province/list', {
        });
        this.provinces = response.data;
      } catch (error) {
        console.error('Error fetching provinces:', error);
      }
    }
  }
});