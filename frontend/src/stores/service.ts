import { defineStore } from 'pinia'
import { createservice, deleteservice, fetchAllService, fetchAllServiceOwner } from '@/api/service'

export const useServiceStore = defineStore('service', {
  state: () => ({
    services: [],
    serviceOwner: [],
  }),
  actions: {
    async getService(id:number) {
      try {
        const response = await fetchAllService(id)
        this.services = response.data.data
      } catch (error) {
        console.error('Error fetching services:', error)
      }
    },
    async getServiceOwner() {
      try {
        const response = await fetchAllServiceOwner()
        this.serviceOwner = response.data.data
      } catch (error) {
        console.error('Error fetching service owner:', error)
      }
    },
    async createServiceOwner(value:object){
      try {
        const response = await createservice(value)
        this.serviceOwner = response.data.data
      } catch (error) {
        console.error('Error fetching service owner:', error)
      }
    },
    async deleteserviceOwner(id:number){
      try {
        const response = await deleteservice(id)
        this.serviceOwner = response.data.data
      } catch (error) {
        console.error('Error fetching service owner:', error)
      }
    }
  }
})
