<template>
  <div>
    <section class="inner-banner bg-overlay-black-70" :style="{ backgroundImage: `url(${hero})`, backgroundSize: 'cover' }">
      <div class="container">
        <div class="row d-flex justify-content-center">
          <div class="col-md-12">
            <div class="text-center">
              <h1 class="text-white">Latest News</h1>
              <p class="text-white-75 mt-3">Stay updated with school news and announcements</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <div class="news-container">

      <div class="space-y-8">
        <article v-for="news in newsItems" :key="news.id" class="bg-white rounded-lg shadow-sm overflow-hidden">
          <div class="p-6">
            <div class="flex items-center mb-4">
              <span class="text-indigo-600 text-sm font-semibold">{{ news.date }}</span>
              <span class="mx-2 text-gray-400">•</span>
              <span class="text-sm text-gray-500">{{ news.category }}</span>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ news.title }}</h2>
            <p class="text-gray-600 mb-4">{{ news.content }}</p>
            <div v-if="news.image" class="mb-4">
              <img :src="news.image" :alt="news.title" class="w-full h-64 object-cover rounded-lg" />
            </div>
            <div class="flex items-center text-sm text-gray-500">
              <span>By {{ news.author }}</span>
            </div>
          </div>
        </article>
      </div>

      <div v-if="loading" class="text-center py-8">
        <span class="text-gray-600">Loading news...</span>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const loading = ref(true)
const newsItems = ref([])

// Fetch both news and announcements, then merge and sort
async function fetchNewsAndAnnouncements() {
  loading.value = true
  try {
    // Fetch news
    const newsRes = await axios.get('/api/news')
    const newsData = Array.isArray(newsRes.data) ? newsRes.data : []
    // Normalize news items
    const normalizedNews = newsData.map(item => ({
      id: `news-${item.id}`,
      date: item.date ? new Date(item.date).toLocaleDateString() : '',
      category: item.category || 'News',
      title: item.title,
      content: item.content,
      author: item.author || 'School',
      image: item.image || null,
      type: 'news'
    }))

    // Fetch announcements
    const annRes = await axios.get('/api/announcements')
    const annData = Array.isArray(annRes.data) ? annRes.data : []
    // Normalize announcements as news items
    const normalizedAnns = annData.map(item => ({
      id: `announcement-${item.id}`,
      date: item.date ? new Date(item.date).toLocaleDateString() : '',
      category: 'Announcement',
      title: item.title,
      content: item.content,
      author: 'Admin',
      image: null,
      type: 'announcement'
    }))

    // Merge and sort by date (descending)
    const merged = [...normalizedNews, ...normalizedAnns].sort((a, b) => {
      return new Date(b.date) - new Date(a.date)
    })
    newsItems.value = merged
  } catch (err) {
    console.error('Error loading news or announcements:', err)
    newsItems.value = []
  } finally {
    loading.value = false
  }
}

onMounted(fetchNewsAndAnnouncements)
</script>