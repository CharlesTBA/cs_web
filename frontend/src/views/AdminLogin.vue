<template>
  <div>
    <NavBar />
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
      <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-2">Admin Login</h2>
        <p class="text-gray-500 text-sm mb-4">Admin account login</p>
        <input v-model="username" placeholder="Username" class="w-full p-2 mb-3 border rounded" />
        <input v-model="password" type="password" placeholder="Password" class="w-full p-2 mb-3 border rounded" />
        <button @click="login" class="w-full bg-blue-600 text-white py-2 rounded">Login</button>
        <div v-if="error" class="text-red-600 mt-2">{{ error }}</div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const username = ref('')
const password = ref('')
const error = ref('')
const router = useRouter()

const API_URL = 'http://localhost:3000'

const login = async () => {
  error.value = ''
  if (!username.value || !password.value) {
    error.value = 'Username and password required'
    return
  }
  try {
    // First check if the backend is reachable
    try {
      const checkResponse = await fetch(API_URL)
      console.log('Backend check response:', await checkResponse.text())
    } catch (e) {
      console.error('Backend server not reachable:', e)
      error.value = 'Backend server is not running. Please try again.'
      return
    }

    console.log('Attempting login with:', { username: username.value })
    const res = await fetch(`${API_URL}/api/staff/admin/login`, {
      method: 'POST',
      headers: { 
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      },
      mode: 'cors',
      credentials: 'include',
      body: JSON.stringify({ 
        username: username.value, 
        password: password.value 
      })
    })
    
    console.log('Response status:', res.status)
    const contentType = res.headers.get('content-type')
    console.log('Content-Type:', contentType)

    if (!contentType || !contentType.includes('application/json')) {
      console.error('Invalid content type:', contentType)
      error.value = 'Invalid server response type'
      return
    }

    const body = await res.json()
    console.log('Response body:', body)
    
    if (!res.ok) {
      console.error('Login failed:', body)
      error.value = body.error || 'Invalid credentials'
      return
    }
    
    if (!body.id || !body.role) {
      console.error('Invalid response format:', body)
      error.value = 'Invalid server response format'
      return
    }
    
    console.log('Login successful:', body)
    localStorage.setItem('admin', JSON.stringify(body))
    // Redirect to Vue admin dashboard
    router.push('/admin')
  } catch (e) {
    console.error('Login error:', e)
    error.value = 'Network error - Please check if the backend server is running on port 3000'
  }
}
</script>
