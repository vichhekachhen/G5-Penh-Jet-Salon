import { defineStore } from 'pinia'
import { sentMail } from '@/api/mail'

export const useMailStore = defineStore('email', {
  state: () => ({
    isSent: '',
  }),
  actions: {
    async toAdmin(email: string) {
      try {
        console.log(email);
        
        // const response = await sentMail(email)
        // this.isSent = response.data.data
        
      } catch (error) {
        this.isSent = 'Cannot sent mail to administrator'  
        console.error('Failed to sent mail:', error)
      }
    }
  }
})
