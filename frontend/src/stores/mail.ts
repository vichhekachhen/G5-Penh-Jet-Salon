import { defineStore } from 'pinia'
import { sentMail } from '@/api/mail'

export const useMailStore = defineStore('email', {
  state: () => ({
    email:'',
    successMessage: '',
    errorMessage: ''
  }),
  actions: {
    async toAdmin(email: object) {
      try {        
        await sentMail(email)
        this.successMessage = "Email sent successfully  !"
        this.email = ''
      } catch (error) {
        this.errorMessage = 'Cannot sent mail to administrator'  
        console.error('Failed to sent mail:', error)
      }
    }
  }
})
