<template>
  <div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Events Calendar</h1>
        <p class="text-xl text-gray-600">Stay updated with school events and activities</p>
      </div>

      <!-- Calendar Navigation -->
      <div class="flex justify-between items-center mb-8">
        <div class="flex space-x-4">
          <button @click="previousMonth" class="p-2 text-gray-600 hover:text-gray-900">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
          </button>
          <h2 class="text-2xl font-bold text-gray-900">{{ currentMonthYear }}</h2>
          <button @click="nextMonth" class="p-2 text-gray-600 hover:text-gray-900">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
          </button>
        </div>
        <div class="flex space-x-2">
          <button 
            v-for="view in views" 
            :key="view"
            @click="currentView = view"
            :class="['px-4 py-2 rounded', currentView === view ? 'bg-indigo-600 text-white' : 'bg-white text-gray-600 hover:bg-gray-50']"
          >
            {{ view }}
          </button>
        </div>
      </div>

      <!-- Calendar Grid -->
      <div v-if="currentView === 'Month'" class="bg-white rounded-lg shadow overflow-hidden">
        <div class="grid grid-cols-7 gap-px border-b">
          <div v-for="day in weekDays" :key="day" class="bg-gray-50 p-4 text-center text-sm font-semibold text-gray-900">{{ day }}</div>
        </div>
        <div class="grid grid-cols-7 gap-px">
          <div v-for="date in calendarDates" :key="date.day" :class="['min-h-32 bg-white p-4', date.isToday ? 'bg-indigo-50' : '', date.isCurrentMonth ? 'text-gray-900' : 'text-gray-400']">
            <div class="font-semibold mb-1">{{ date.day }}</div>
            <div v-if="date.events" class="space-y-1">
              <div v-for="event in date.events" :key="event.id" class="text-xs p-1 rounded text-white" :class="event.type === 'academic' ? 'bg-blue-500' : 'bg-green-500'">
                {{ event.title }}
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- List View -->
      <div v-else class="bg-white rounded-lg shadow divide-y">
        <div v-for="event in upcomingEvents" :key="event.id" class="p-6 hover:bg-gray-50">
          <div class="flex items-center justify-between">
            <div>
              <h3 class="text-lg font-semibold text-gray-900">{{ event.title }}</h3>
              <p class="mt-1 text-sm text-gray-600">{{ event.description }}</p>
            </div>
            <div class="text-right">
              <span class="text-sm font-medium text-indigo-600">{{ event.date }}</span>
              <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium" :class="event.type === 'academic' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800'">
                {{ event.type }}
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'

const currentDate = ref(new Date())
const currentView = ref('Month')
const views = ['Month', 'List']
const weekDays = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']

const events = [
  {
    id: 1,
    title: 'Open House',
    description: 'School open house for prospective students and parents',
    date: '2025-11-15',
    type: 'academic'
  },
  {
    id: 2,
    title: 'Science Fair',
    description: 'Annual science fair showcasing student projects',
    date: '2025-11-20',
    type: 'academic'
  },
  {
    id: 3,
    title: 'Sports Day',
    description: 'Annual sports competition and athletic events',
    date: '2025-11-25',
    type: 'extracurricular'
  }
]

const currentMonthYear = computed(() => {
  return currentDate.value.toLocaleString('default', { month: 'long', year: 'numeric' })
})

const calendarDates = computed(() => {
  // This would be implemented to return the calendar grid dates
  // Including previous month, current month, and next month dates
  return []
})

const upcomingEvents = computed(() => {
  return events.sort((a, b) => new Date(a.date) - new Date(b.date))
})

const previousMonth = () => {
  currentDate.value = new Date(currentDate.value.setMonth(currentDate.value.getMonth() - 1))
}

const nextMonth = () => {
  currentDate.value = new Date(currentDate.value.setMonth(currentDate.value.getMonth() + 1))
}
</script>