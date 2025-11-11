<template>
  <div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Academic Programs</h1>
        <p class="text-xl text-gray-600">Discover our comprehensive educational offerings</p>
      </div>

      <!-- Programs Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div v-for="program in programs" :key="program.id" class="bg-white rounded-lg shadow-sm overflow-hidden">
          <div class="p-6">
            <h3 class="text-xl font-bold text-indigo-600 mb-3">{{ program.name }}</h3>
            <p class="text-gray-600 mb-4">{{ program.description }}</p>
            <ul class="space-y-2 mb-4">
              <li v-for="feature in program.features" :key="feature" class="flex items-center text-gray-600">
                <svg class="h-5 w-5 text-indigo-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                </svg>
                {{ feature }}
              </li>
            </ul>
            <button class="w-full bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition-colors">
              Learn More
            </button>
          </div>
        </div>
      </div>

      <!-- Academic Calendar -->
      <div class="mt-16">
        <h2 class="text-3xl font-bold text-center mb-8">Academic Calendar</h2>
        <div class="bg-white rounded-lg shadow-sm p-6">
          <div v-for="event in calendar" :key="event.id" class="border-b last:border-b-0 py-4">
            <div class="flex justify-between items-center">
              <div>
                <h4 class="font-semibold text-gray-900">{{ event.title }}</h4>
                <p class="text-gray-600">{{ event.description }}</p>
              </div>
              <span class="text-indigo-600 font-medium">{{ event.date }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const programs = ref([
  {
    id: 1,
    name: 'Science & Technology',
    description: 'Comprehensive STEM education with hands-on laboratory experience.',
    features: [
      'Advanced Physics Labs',
      'Computer Programming',
      'Robotics Club',
      'Science Research Projects'
    ]
  },
  {
    id: 2,
    name: 'Liberal Arts',
    description: 'Develop critical thinking and creativity through diverse subjects.',
    features: [
      'Literature Studies',
      'Fine Arts Programs',
      'Social Sciences',
      'Creative Writing'
    ]
  },
  {
    id: 3,
    name: 'Business Studies',
    description: 'Prepare for the business world with practical knowledge.',
    features: [
      'Economics',
      'Business Management',
      'Entrepreneurship',
      'Financial Literacy'
    ]
  }
])

const calendar = ref([
  {
    id: 1,
    title: 'First Semester Begins',
    description: 'Start of academic year 2025-2026',
    date: 'Aug 15, 2025'
  },
  {
    id: 2,
    title: 'Winter Break',
    description: 'Holiday season break',
    date: 'Dec 20-Jan 5'
  },
  {
    id: 3,
    title: 'Final Examinations',
    description: 'End of year assessments',
    date: 'May 15-30, 2026'
  }
])
</script>