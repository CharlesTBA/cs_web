<template>
  <div class="min-h-screen bg-gray-100">
    <nav class="bg-white shadow">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
          <div class="flex">
            <div class="flex-shrink-0 flex items-center">
              <h1 class="text-xl font-bold">Professor Dashboard</h1>
            </div>
          </div>
          <div class="flex items-center">
            <span class="text-gray-700 mr-4">{{ professorName }}</span>
            <button @click="logout" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
              Logout
            </button>
          </div>
        </div>
      </div>
    </nav>

    <div class="py-6">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded-lg p-6">
          <h2 class="text-lg font-semibold mb-4">Welcome back, {{ professorName }}</h2>
          <div class="space-y-4">
            <div class="border-t pt-4">
              <h3 class="font-medium mb-2">Your Courses</h3>
              <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div v-for="course in professorData.courses" :key="course" class="bg-gray-50 p-4 rounded">
                  {{ course }}
                </div>
              </div>
            </div>
            <div class="border-t pt-4">
              <h3 class="font-medium mb-2">Department</h3>
              <p>{{ professorData.department }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const professorName = ref('')
const professorData = ref({
  name: '',
  department: '',
  courses: []
})

onMounted(() => {
  const profData = localStorage.getItem('professor')
  if (!profData) {
    router.push('/professor-login')
    return
  }
  
  const professor = JSON.parse(profData)
  professorName.value = professor.name
  professorData.value = professor
})

const logout = () => {
  localStorage.removeItem('professor')
  router.push('/professor-login')
}
</script>