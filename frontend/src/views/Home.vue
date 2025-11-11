<template>
  <div class="min-h-screen bg-gray-50">
    <!-- Hero Section -->
    <section class="relative bg-indigo-600 text-white">
      <div class="max-w-7xl mx-auto py-24 px-4 sm:px-6 lg:px-8">
        <div class="text-center">
          <h1 class="text-4xl md:text-6xl font-bold mb-4">Welcome to Our School</h1>
          <p class="text-xl md:text-2xl mb-8">Nurturing minds, building futures</p>
          <a href="#" class="bg-white text-indigo-600 px-8 py-3 rounded-lg font-semibold hover:bg-indigo-50 transition-colors">
            Learn More
          </a>
        </div>
      </div>
      <div class="absolute bottom-0 left-0 right-0 h-20 bg-gradient-to-t from-gray-50"></div>
    </section>

    <!-- Features Section -->
    <section class="py-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <h3 class="text-xl font-semibold mb-4 text-indigo-600">Academic Excellence</h3>
            <p class="text-gray-600">Our commitment to high academic standards ensures students reach their full potential.</p>
          </div>
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <h3 class="text-xl font-semibold mb-4 text-indigo-600">Expert Faculty</h3>
            <p class="text-gray-600">Learn from experienced educators dedicated to student success.</p>
          </div>
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <h3 class="text-xl font-semibold mb-4 text-indigo-600">Modern Facilities</h3>
            <p class="text-gray-600">State-of-the-art facilities supporting a dynamic learning environment.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- News & Events Preview -->
    <section class="bg-white py-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center mb-12">Latest News & Events</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
          <div v-for="item in latestNews" :key="item.id" class="border rounded-lg overflow-hidden">
            <div class="p-6">
              <span class="text-indigo-600 text-sm font-semibold">{{ item.date }}</span>
              <h3 class="text-xl font-bold mt-2 mb-3">{{ item.title }}</h3>
              <p class="text-gray-600">{{ item.excerpt }}</p>
              <a href="#" class="text-indigo-600 font-medium mt-4 inline-block">Read more →</a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const latestNews = ref([
  {
    id: 1,
    date: 'Nov 7, 2025',
    title: 'School Achieves Excellence Award',
    excerpt: 'Our school has been recognized for outstanding academic achievements and innovative teaching methods.'
  },
  {
    id: 2,
    date: 'Nov 6, 2025',
    title: 'Upcoming Science Fair',
    excerpt: 'Join us for our annual Science Fair showcasing student projects and innovations.'
  }
])
</script>