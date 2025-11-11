
<template>
  <div>
    <section class="inner-banner bg-overlay-black-70" :style="{ backgroundImage: 'url(/images/hole.png)', backgroundSize: 'cover' }">
      <div class="container">
        <div class="row d-flex justify-content-center">
          <div class="col-md-12">
            <div class="text-center">
              <h1 class="text-white">Subjects</h1>
              <p class="text-white-75 mt-3">Browse your enrolled subjects</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <div class="container py-8">
      <div class="bg-white rounded-lg shadow-sm p-6">
        <div v-if="store.loading" class="flex justify-center items-center py-8">
          <div class="spinner"></div>
        </div>
        <div v-else-if="store.error" class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded relative" role="alert">
          <strong class="font-bold">Error!</strong>
          <span class="block sm:inline"> Unable to load subjects. Please try again later.</span>
        </div>
        <div v-else>
          <ul v-if="store.subjects.length" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <li v-for="s in store.subjects" :key="s.id" class="bg-gray-50 p-4 rounded shadow hover:bg-white transition">
              <div class="font-medium text-lg">{{ s.name }}</div>
              <div class="text-sm text-gray-500">{{ s.code }}</div>
            </li>
          </ul>
          <div v-else class="text-center py-8 text-gray-500">
            No subjects available at this time.
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useMainStore } from '../store'
import { onMounted } from 'vue'
const store = useMainStore()
onMounted(() => store.fetchSubjects())
</script>
<style scoped>
.inner-banner {
  min-height: 300px;
  display: flex;
  align-items: center;
  justify-content: center;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  position: relative;
  margin-bottom: 2rem;
}
.inner-banner::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.5);
  z-index: 1;
}
.inner-banner .container {
  position: relative;
  z-index: 2;
}
.inner-banner h1 {
  font-size: 2.5rem;
  font-weight: 700;
  margin-bottom: 1rem;
  color: #fff;
  text-shadow: 0 2px 4px rgba(0,0,0,0.2);
}
.inner-banner p {
  font-size: 1.2rem;
  color: rgba(255,255,255,0.9);
}
.spinner {
  width: 40px;
  height: 40px;
  border: 4px solid #f3f3f3;
  border-top: 4px solid #3498db;
  border-radius: 50%;
  animation: spin 1s linear infinite;
}
@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
@media (max-width: 640px) {
  .inner-banner {
    min-height: 200px;
  }
  .inner-banner h1 {
    font-size: 2rem;
  }
}
</style>
