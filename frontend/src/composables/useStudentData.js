import { ref, onMounted, onUnmounted } from 'vue'
import axios from 'axios'

const baseURL = 'http://localhost:3000'

export function useStudentData() {
  const courses = ref([])
  const announcements = ref([])
  const grades = ref([])
  const loading = ref(true)
  const error = ref(null)

  const fetchCourses = async () => {
    try {
      const response = await axios.get(`${baseURL}/api/courses`)
      courses.value = response.data
    } catch (err) {
      error.value = 'Error loading courses'
      console.error(err)
    }
  }

  const fetchAnnouncements = async () => {
    try {
      const response = await axios.get(`${baseURL}/api/announcements/recent`)
      announcements.value = response.data
    } catch (err) {
      error.value = 'Error loading announcements'
      console.error(err)
    }
  }

  const fetchGrades = async () => {
    try {
      const response = await axios.get(`${baseURL}/api/grades`)
      grades.value = response.data
    } catch (err) {
      error.value = 'Error loading grades'
      console.error(err)
    }
  }

  const calculateGPA = () => {
    if (!grades.value.length) return 'N/A'
    
    const total = grades.value.reduce((sum, grade) => sum + grade.grade, 0)
    const average = total / grades.value.length
    
    // Convert to 4.0 scale (assuming grades are out of 100)
    if (average >= 93) return '4.0'
    if (average >= 90) return '3.7'
    if (average >= 87) return '3.3'
    if (average >= 83) return '3.0'
    if (average >= 80) return '2.7'
    if (average >= 77) return '2.3'
    if (average >= 73) return '2.0'
    if (average >= 70) return '1.7'
    if (average >= 67) return '1.3'
    if (average >= 63) return '1.0'
    if (average >= 60) return '0.7'
    return '0.0'
  }

  let pollInterval = null
  onMounted(async () => {
    try {
      await Promise.all([
        fetchCourses(),
        fetchAnnouncements(),
        fetchGrades()
      ])
      // start polling announcements so students see new admin posts without a full page reload
      pollInterval = setInterval(fetchAnnouncements, 15000) // every 15s
      loading.value = false
    } catch (err) {
      error.value = 'Error loading student data'
      loading.value = false
    }
  })

  onUnmounted(() => {
    if (pollInterval) clearInterval(pollInterval)
  })

  return {
    courses,
    announcements,
    grades,
    loading,
    error,
    calculateGPA,
    fetchCourses,
    fetchAnnouncements,
    fetchGrades
  }
}