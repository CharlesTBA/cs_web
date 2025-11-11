<template>
  <div class="min-h-screen bg-gray-50">
    <div class="max-w-2xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-10">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Contact Us</h1>
        <p class="text-lg text-gray-600">We'd love to hear from you! Please fill out the form below.</p>
      </div>
      <form class="bg-white rounded-lg shadow p-8 space-y-6" @submit.prevent="submitForm">
        <div>
          <label class="block text-gray-700 font-semibold mb-2">Your Name</label>
          <input v-model="form.name" type="text" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required />
        </div>
        <div>
          <label class="block text-gray-700 font-semibold mb-2">Email Address</label>
          <input v-model="form.email" type="email" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required />
        </div>
        <div>
          <label class="block text-gray-700 font-semibold mb-2">Message</label>
          <textarea v-model="form.message" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" rows="4" required></textarea>
        </div>
        <button type="submit" class="w-full bg-indigo-600 text-white font-semibold py-3 rounded hover:bg-indigo-700 transition">Send Message</button>
        <div v-if="submitted" class="text-green-600 font-semibold text-center mt-4">Message sent! Thank you.</div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const form = ref({ name: '', email: '', message: '' })
const submitted = ref(false)

function submitForm() {
  submitted.value = true
  setTimeout(() => {
    form.value = { name: '', email: '', message: '' }
    submitted.value = false
  }, 2000)
}
</script>