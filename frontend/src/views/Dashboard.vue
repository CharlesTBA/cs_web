<template>
  <div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 py-8">
      <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Welcome, {{ studentName }}</h1>
        <p class="text-gray-600">Student ID: {{ studentId }}</p>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-lg shadow">
          <h3 class="text-lg font-semibold mb-2">Current GPA</h3>
          <p class="text-3xl font-bold text-blue-600">{{ studentGPA }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
          <h3 class="text-lg font-semibold mb-2">Upcoming Deadlines</h3>
          <ul class="space-y-2">
            <li v-for="course in courses" :key="course.id">
              <div v-for="assignment in course.assignments" :key="assignment.id" class="text-sm">
                <span class="text-red-500">{{ assignment.dueDate }}</span>
                <span class="font-medium">{{ assignment.title }}</span>
              </div>
            </li>
          </ul>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
          <h3 class="text-lg font-semibold mb-2">Latest Announcements</h3>
          <ul class="space-y-2">
            <li v-for="announcement in announcements" :key="announcement.id" class="text-sm">
              <span class="font-medium">{{ announcement.title }}</span>
              <span class="text-gray-500 ml-2">{{ announcement.date }}</span>
            </li>
          </ul>
        </div>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white p-6 rounded-lg shadow">
          <h2 class="text-xl font-semibold mb-4">📚 My Courses</h2>
          <div class="space-y-4">
            <div v-for="course in courses" :key="course.id" class="p-4 border rounded hover:bg-blue-50 cursor-pointer transition-colors">
              <h3 class="font-medium">{{ course.name }}</h3>
              <p class="text-sm text-gray-600">{{ course.instructor }}</p>
              <div class="mt-2 flex space-x-2">
                <span class="text-xs px-2 py-1 bg-blue-100 text-blue-800 rounded">Materials</span>
                <span class="text-xs px-2 py-1 bg-green-100 text-green-800 rounded">Assignments</span>
              </div>
            </div>
          </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
          <h2 class="text-xl font-semibold mb-4">🗓️ Schedule</h2>
          <div class="grid grid-cols-7 gap-1">
            <template v-for="day in ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']">
              <div class="text-center font-medium text-sm py-2">{{ day }}</div>
            </template>
            <template v-for="n in 31">
              <div class="text-center py-2 text-sm rounded hover:bg-blue-50 cursor-pointer">{{ n }}</div>
            </template>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-lg shadow">
          <h2 class="text-xl font-semibold mb-4">🪪 Profile</h2>
          <div class="space-y-3">
            <div class="flex items-center space-x-4">
              <div class="w-16 h-16 bg-gray-200 rounded-full"></div>
              <div>
                <p class="font-medium">{{ studentName }}</p>
                <p class="text-sm text-gray-600">Computer Science</p>
              </div>
            </div>
            <button class="w-full mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Edit Profile</button>
          </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
          <h2 class="text-xl font-semibold mb-4">🏫 School Information</h2>
          <div class="space-y-4">
            <div class="text-center py-4">
              <h3 class="font-bold text-lg text-blue-800">50 Years of Excellence</h3>
              <p class="text-sm text-gray-600">Honoring the Past, Imagining the Future</p>
              <p class="text-sm italic text-blue-600 mt-2">#NurturingExcellenceTransformingLives</p>
            </div>
            <div class="space-y-2">
              <div class="flex items-center text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span>Concepcion, Philippines</span>
              </div>
              <div class="flex items-center text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <a href="mailto:info@chcc.edu.ph" class="hover:text-blue-600">info@chcc.edu.ph</a>
              </div>
              <div class="flex items-center text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                </svg>
                <span>(045) 923 0747</span>
              </div>
              <div class="flex items-center text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                </svg>
                <a href="https://chcc.edu.ph" target="_blank" class="hover:text-blue-600">chcc.edu.ph</a>
              </div>
              <div class="flex items-center text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                <span>Private School</span>
              </div>
            </div>
          </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
          <h2 class="text-xl font-semibold mb-4">💬 Support</h2>
          <div class="space-y-3">
            <a href="https://www.facebook.com/ConcepcionHolyCrossCollege" target="_blank" class="w-full block px-4 py-2 text-left border rounded hover:bg-blue-50 text-blue-700 font-medium transition">
              Contact us on Facebook
            </a>
            <button class="w-full px-4 py-2 text-left border rounded hover:bg-gray-50">📢 View Announcements</button>
          </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
          <h2 class="text-xl font-semibold mb-4">🔗 Quick Links</h2>
          <div class="space-y-3">
            <a href="#" class="block px-4 py-2 text-blue-600 hover:bg-blue-50 rounded">📊 View All Grades</a>
            <a href="#" class="block px-4 py-2 text-blue-600 hover:bg-blue-50 rounded">📅 Full Calendar</a>
            <a href="#" class="block px-4 py-2 text-blue-600 hover:bg-blue-50 rounded">📚 Course Catalog</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { computed } from 'vue'
import { useAuthStore } from '../store/auth'
import { useStudentData } from '../composables/useStudentData'

export default {
  setup() {
    const authStore = useAuthStore()
    const { courses, announcements, grades } = useStudentData()

    const studentName = computed(() => authStore.studentName || 'Student')
    const studentId = computed(() => authStore.studentId || 'N/A')

    const studentFullName = computed(() => {
      const f = authStore.firstName || ''
      const l = authStore.lastName || ''
      return `${f} ${l}`.trim()
    })

    const studentGrades = computed(() => {
      if (!grades.value || !studentFullName.value) return []
      const f = (authStore.firstName || '').toLowerCase()
      const l = (authStore.lastName || '').toLowerCase()
      return grades.value.filter(g => {
        const name = (g.studentName || '').toLowerCase()
        return name === studentFullName.value.toLowerCase() || (f && name.includes(f)) || (l && name.includes(l))
      })
    })

    const studentGPA = computed(() => {
      if (!studentGrades.value.length) return 'N/A'
      const total = studentGrades.value.reduce((sum, g) => sum + (Number(g.grade) || 0), 0)
      const average = total / studentGrades.value.length
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
    })

    return {
      studentName,
      studentId,
      courses,
      announcements,
      grades,
      studentGPA
    }
  }
}
</script>
