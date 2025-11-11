<template>
  <div class="max-w-md mx-auto mt-10 bg-white p-6 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Student Registration</h2>
    
    <form @submit.prevent="handleRegister" class="space-y-4">
      <div>
        <label class="block text-gray-700 mb-2">Student ID (8 digits)</label>
        <input 
          v-model="studentId"
          type="text"
          placeholder="Enter your student ID"
          class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
      </div>

      <div>
        <label class="block text-gray-700 mb-2">First Name</label>
        <input 
          v-model="firstName"
          type="text"
          placeholder="Enter your first name"
          class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
      </div>
      
      <div>
        <label class="block text-gray-700 mb-2">Last Name</label>
        <input 
          v-model="lastName"
          type="text"
          placeholder="Enter your last name"
          class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
      </div>

      <div v-if="error" class="text-red-500 text-sm">{{ error }}</div>
      
      <button 
        type="submit"
        class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
      >
        Register
      </button>
    </form>

    <p class="mt-4 text-center text-gray-600">
      Already have an account? 
      <router-link to="/login" class="text-blue-600 hover:underline">Login</router-link>
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
    const firstName = ref('')
    const lastName = ref('')
    const error = ref('')

    const handleRegister = async () => {
      if (!studentId.value || !firstName.value || !lastName.value) {
        error.value = 'Please fill in all fields'
        return
      }

      if (!/^\d{8}$/.test(studentId.value)) {
        error.value = 'Student ID must be 8 digits'
        return
      }

      const success = await store.register(studentId.value, firstName.value, lastName.value)
      if (success) {
        router.push('/login')
      } else {
        error.value = 'Registration failed. Student ID might already exist.'
      }
    }

    return {
      studentId,
      firstName,
      lastName,
      error,
      handleRegister
    }
  }
}
</script>