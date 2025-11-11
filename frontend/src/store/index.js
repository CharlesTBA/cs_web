import { defineStore } from 'pinia'
import axios from 'axios'

// Ensure API calls from the frontend during development target the backend server
// (Vite runs on a different port). Using axios.defaults.baseURL keeps existing
// relative paths (e.g. '/api/grades') working without changing all callers.
axios.defaults.baseURL = 'http://localhost:3000'

export const useMainStore = defineStore('main', {
  state: () => ({
    grades: [],
    subjects: [],
    loading: false,
    error: null
  }),
  actions: {
    async fetchGrades() {
      this.loading = true
      this.error = null
      try {
        const res = await axios.get('/api/grades')
        this.grades = res.data
      } catch (err) {
        console.error('Error fetching grades:', err)
        this.error = err.response?.data?.message || err.message || 'Failed to load grades'
      } finally {
        this.loading = false
      }
    },
    async fetchSubjects() {
      this.loading = true
      try {
        const res = await axios.get('/api/subjects')
        this.subjects = res.data
      } catch (err) {
        this.error = err
      } finally {
        this.loading = false
      }
    }
  }
})
