<template>
  <nav class="bg-blue-600 text-white shadow">
    <div class="max-w-6xl mx-auto px-4">
      <div class="flex justify-between h-16">
        <div class="flex items-center">
          <img src="/images/logo.jpg" alt="Logo" class="w-10 h-10 rounded-full mr-3 border-2 border-white shadow" />
          <router-link to="/" class="text-xl font-bold tracking-wide">Holy Cross College</router-link>
        </div>

        <div class="flex items-center space-x-2 md:space-x-4">
          <template v-if="isAuthenticated">
            <router-link to="/grades" class="hover:bg-blue-700 px-3 py-2 rounded transition">Grades</router-link>
            <router-link to="/subjects" class="hover:bg-blue-700 px-3 py-2 rounded transition">Subjects</router-link>
            <router-link to="/academics" class="hover:bg-blue-700 px-3 py-2 rounded transition">Programs</router-link>
            <router-link to="/admissions" class="hover:bg-blue-700 px-3 py-2 rounded transition">Admissions</router-link>
            <router-link to="/news" class="hover:bg-blue-700 px-3 py-2 rounded transition">News</router-link>
            <div class="relative group">
              <button class="hover:bg-blue-700 px-3 py-2 rounded transition flex items-center">School Info ▾</button>
              <div class="absolute right-0 mt-2 w-48 bg-white text-black rounded shadow-lg z-30 hidden group-hover:block">
                <router-link to="/board" class="block px-4 py-2 hover:bg-gray-100">Board of Trustees</router-link>
                <router-link to="/core-values" class="block px-4 py-2 hover:bg-gray-100">Core Values</router-link>
                <router-link to="/philosophy" class="block px-4 py-2 hover:bg-gray-100">Philosophy</router-link>
                  <router-link to="/vision-mission" class="block px-4 py-2 hover:bg-gray-100">Vision & Mission</router-link>
                <router-link to="/symbols" class="block px-4 py-2 hover:bg-gray-100">Symbols</router-link>
                <router-link to="/hymn" class="block px-4 py-2 hover:bg-gray-100">Hymn</router-link>
              </div>
            </div>
            <span class="text-sm font-medium">{{ studentName }}</span>
            <button @click="logout" class="hover:bg-blue-700 px-3 py-2 rounded transition">Logout</button>
          </template>
          <template v-else>
            <router-link to="/login" class="hover:bg-blue-700 px-3 py-2 rounded transition">Login</router-link>
            <router-link to="/register" class="hover:bg-blue-700 px-3 py-2 rounded transition">Register</router-link>
            <div class="relative">
              <button @click="openStaff = !openStaff" class="px-3 py-2 rounded hover:bg-blue-700 transition">Staff ▾</button>
              <div v-if="openStaff" class="absolute right-0 mt-2 w-48 bg-white text-black rounded shadow-lg z-30">
                <router-link to="/admin-login" class="block px-4 py-2 hover:bg-gray-100">Admin Login</router-link>
                <router-link to="/professor-login" class="block px-4 py-2 hover:bg-gray-100">Professor Login</router-link>
              </div>
            </div>
          </template>
        </div>
      </div>
    </div>
  </nav>
</template>

<script>
import { computed, ref } from 'vue'
import { useAuthStore } from '../store/auth'

export default {
  setup() {
    const store = useAuthStore()
    const isAuthenticated = computed(() => store.isAuthenticated)
    const studentName = computed(() => store.studentName)
    const logout = () => { store.logout() }
    const openStaff = ref(false)
    // close dropdown on outside click (basic)
    if (typeof window !== 'undefined') {
      window.addEventListener('click', (e) => {
        const target = e.target
        // very small check — if clicking outside buttons, close
        if (!target.closest) return
        if (!target.closest('.relative')) {
          openStaff.value = false
        }
      })
    }
    return { isAuthenticated, studentName, logout, openStaff }
  }
}
</script>
