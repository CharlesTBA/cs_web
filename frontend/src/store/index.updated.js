import { defineStore } from 'pinia'
import axios from 'axios'
import { API_BASE_URL } from '../config/api'

// Use the API base URL from config
axios.defaults.baseURL = API_BASE_URL

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
