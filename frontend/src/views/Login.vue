<template>
  <div class="max-w-md mx-auto mt-10 bg-white p-6 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Student Login</h2>
    
    <form @submit.prevent="handleLogin" class="space-y-4">
      <div>
        <label class="block text-gray-700 mb-2">Student ID</label>
        <input 
          v-model="studentId"
          type="text"
          placeholder="Enter your student ID"
          class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
      </div>
      
      <div>
        <label class="block text-gray-700 mb-2">Password (Last Name)</label>
        <input 
          v-model="password"
          type="password"
          placeholder="Enter your last name"
          class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
      </div>

      <div v-if="error" class="text-red-500 text-sm">{{ error }}</div>
      
      <button 
        type="submit"
        class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
      >
        Login
      </button>
    </form>

    <p class="mt-4 text-center text-gray-600">
      Don't have an account? 
      <router-link to="/register" class="text-blue-600 hover:underline">Register</router-link>
    </p>
  </div>
</template>

<script>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '../store/auth'

export default {
  setup() {
    const router = useRouter()
    const store = useAuthStore()
    
    const studentId = ref('')
    const password = ref('')
    const error = ref('')

    const handleLogin = async () => {
      if (!studentId.value || !password.value) {
        error.value = 'Please fill in all fields'
        return
      }

      const success = await store.login(studentId.value, password.value)
      if (success) {
        router.push('/')
      } else {
        error.value = 'Invalid student ID or password'
      }
    }

    return {
      studentId,
      password,
      error,
      handleLogin
    }
  }
}
</script>