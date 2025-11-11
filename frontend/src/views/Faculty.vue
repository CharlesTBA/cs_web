<template>
  <div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Faculty Directory</h1>
        <p class="text-xl text-gray-600">Meet our dedicated teaching staff</p>
      </div>

      <!-- Department Filter -->
      <div class="mb-8">
        <div class="flex flex-wrap gap-2">
          <button
            v-for="dept in departments"
            :key="dept"
            @click="selectedDepartment = dept"
            :class="[
              'px-4 py-2 rounded-full text-sm font-medium',
              selectedDepartment === dept ? 'bg-indigo-600 text-white' : 'bg-white text-gray-600 hover:bg-gray-50'
            ]"
          >
            {{ dept }}
          </button>
        </div>
      </div>

      <!-- Search Bar -->
      <div class="mb-8">
        <div class="max-w-lg mx-auto">
          <div class="relative">
            <input
              v-model="searchQuery"
              type="text"
              placeholder="Search faculty by name or department..."
              class="w-full px-4 py-2 rounded-lg border focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
            />
            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
              <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
              </svg>
            </div>
          </div>
        </div>
      </div>

      <!-- Faculty Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div
          v-for="member in filteredFaculty"
          :key="member.id"
          class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow"
        >
          <div class="aspect-w-3 aspect-h-2">
            <img :src="member.image" :alt="member.name" class="w-full h-48 object-cover" />
          </div>
          <div class="p-6">
            <h3 class="text-xl font-bold text-gray-900">{{ member.name }}</h3>
            <p class="text-sm text-indigo-600 mb-2">{{ member.position }}</p>
            <p class="text-gray-600 mb-4">{{ member.department }}</p>
            <div class="space-y-2">
              <p class="text-sm text-gray-500 flex items-center">
                <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                {{ member.email }}
              </p>
              <p class="text-sm text-gray-500 flex items-center">
                <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                {{ member.education }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'

const searchQuery = ref('')
const selectedDepartment = ref('All Departments')

const departments = [
  'All Departments',
  'Science',
  'Mathematics',
  'English',
  'History',
  'Arts',
  'Physical Education'
]

const faculty = ref([
  {
    id: 1,
    name: 'Dr. John Smith',
    position: 'Head of Science Department',
    department: 'Science',
    email: 'john.smith@school.edu',
    education: 'Ph.D. in Physics',
    image: 'https://example.com/faculty/john-smith.jpg'
  },
  {
    id: 2,
    name: 'Prof. Sarah Johnson',
    position: 'Senior Mathematics Teacher',
    department: 'Mathematics',
    email: 'sarah.johnson@school.edu',
    education: 'M.Sc. in Mathematics',
    image: 'https://example.com/faculty/sarah-johnson.jpg'
  },
  {
    id: 3,
    name: 'Ms. Emily Brown',
    position: 'English Literature Teacher',
    department: 'English',
    email: 'emily.brown@school.edu',
    education: 'M.A. in English Literature',
    image: 'https://example.com/faculty/emily-brown.jpg'
  }
])

const filteredFaculty = computed(() => {
  let filtered = faculty.value
  if (selectedDepartment.value !== 'All Departments') filtered = filtered.filter(m => m.department === selectedDepartment.value)
  if (searchQuery.value) {
    const q = searchQuery.value.toLowerCase()
    filtered = filtered.filter(m => m.name.toLowerCase().includes(q) || m.department.toLowerCase().includes(q) || m.position.toLowerCase().includes(q))
  }
  return filtered
})
</script>