import { defineStore } from 'pinia'
import axios from 'axios'

export const useAuthStore = defineStore('auth', {
  state: () => ({
    baseURL: 'http://localhost:3000',
    studentId: localStorage.getItem('studentId') || null,
    firstName: localStorage.getItem('firstName') || null,
    lastName: localStorage.getItem('lastName') || null
  }),
  
  getters: {
    isAuthenticated: (state) => !!state.studentId,
    studentName: (state) => state.firstName ? `${state.firstName} ${state.lastName}` : ''
  },
  
  actions: {
    async login(studentId, password) {
      try {
        const response = await axios.post(`${this.baseURL}/api/auth/login`, { studentId, password })
        this.studentId = response.data.id
        this.firstName = response.data.firstName
        this.lastName = response.data.lastName
        localStorage.setItem('studentId', this.studentId)
        localStorage.setItem('firstName', this.firstName)
        localStorage.setItem('lastName', this.lastName)
        return true
      } catch (error) {
        console.error('Login failed:', error)
        return false
      }
    },

    async register(studentId, firstName, lastName) {
      try {
        await axios.post(`${this.baseURL}/api/auth/register`, { 
          studentId,
          firstName,
          lastName
        })
        return true
      } catch (error) {
        console.error('Registration failed:', error)
        return false
      }
    },

    logout() {
      this.studentId = null
      this.firstName = null
      this.lastName = null
      localStorage.removeItem('studentId')
      localStorage.removeItem('firstName')
      localStorage.removeItem('lastName')
    }
  }
})