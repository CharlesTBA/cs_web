<template>
  <div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
      <h2 class="text-2xl font-bold mb-2">Professor Login</h2>
      <p class="text-gray-500 text-sm mb-4">Use your staff username and password</p>
      <input v-model="username" placeholder="Username" class="w-full p-2 mb-3 border rounded" />
      <input v-model="password" type="password" placeholder="Password" class="w-full p-2 mb-3 border rounded" />
      <button @click="login" class="w-full bg-blue-600 text-white py-2 rounded">Login</button>
      <div v-if="error" class="text-red-600 mt-2">{{ error }}</div>
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
    // Proceed directly with login - we'll handle connection errors if they occur
    console.log('Attempting professor login:', { username: username.value })

    console.log('Attempting professor login:', { username: username.value })
    const res = await fetch(`${API_URL}/api/staff/professor/login`, {
      method: 'POST',
      headers: { 
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      },
      mode: 'cors',
      credentials: 'include',
      body: JSON.stringify({ username: username.value, password: password.value })
    })
    if (!res.ok) {
      const body = await res.json().catch(() => ({ error: 'Login failed' }))
      error.value = body.error || 'Invalid credentials'
      return
    }
    const data = await res.json()
    localStorage.setItem('professor', JSON.stringify(data))
    // Redirect to professor dashboard using Vue Router
    try {
      router.push('/professor')
    } catch (err) {
      console.error('Router navigation failed:', err)
      // Fallback to hash URL if router fails
      window.location.href = 'http://localhost:5182/#/professor'
    }
  } catch (e) {
    console.error('Professor login/network error:', e)
    error.value = 'Network error — see console for details'
  }
}
</script>
