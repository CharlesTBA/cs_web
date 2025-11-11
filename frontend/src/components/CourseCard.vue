<template>
  <div class="bg-white p-4 rounded-lg shadow-md">
    <div class="flex items-center justify-between">
      <h3 class="text-lg font-semibold">{{ course.name }}</h3>
      <span class="text-sm text-gray-500">{{ course.code }}</span>
    </div>
    <p class="text-sm text-gray-600 mt-1">{{ course.instructor }}</p>
    <div class="mt-3">
      <div class="text-sm text-gray-600">
        <span v-for="(day, index) in course.schedule.days" :key="day">
          {{ day }}{{ index < course.schedule.days.length - 1 ? ', ' : '' }}
        </span>
        <span class="ml-2">{{ course.schedule.time }}</span>
      </div>
    </div>
    <div v-if="course.assignments && course.assignments.length" class="mt-4">
      <h4 class="text-sm font-semibold mb-2">Upcoming Assignments</h4>
      <ul class="space-y-2">
        <li v-for="assignment in course.assignments" :key="assignment.id"
            class="text-sm p-2 bg-gray-50 rounded">
          <div class="flex justify-between items-center">
            <span>{{ assignment.title }}</span>
            <span class="text-red-500">Due: {{ formatDate(assignment.dueDate) }}</span>
          </div>
        </li>
      </ul>
    </div>
    <div class="mt-4 flex space-x-2">
      <button 
        @click="$emit('view-materials')" 
        class="px-3 py-1 text-sm bg-blue-100 text-blue-700 rounded hover:bg-blue-200"
      >
        Materials
      </button>
      <button 
        @click="$emit('view-assignments')"
        class="px-3 py-1 text-sm bg-green-100 text-green-700 rounded hover:bg-green-200"
      >
        Assignments
      </button>
    </div>
  </div>
</template>

<script>
export default {
  name: 'CourseCard',
  props: {
    course: {
      type: Object,
      required: true
    }
  },
  methods: {
    formatDate(dateString) {
      return new Date(dateString).toLocaleDateString('en-US', {
        month: 'short',
        day: 'numeric'
      })
    }
  }
}
</script>