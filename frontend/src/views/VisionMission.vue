<template>
  <div class="min-h-screen bg-gray-50">
    <section class="inner-banner bg-overlay-black-70" :style="{ backgroundImage: `url(/images/hole.png)`, backgroundSize: 'cover' }">
      <div class="container">
        <div class="row d-flex justify-content-center">
          <div class="col-md-12">
            <div class="text-center">
              <h1 class="text-white">Vision and Mission</h1>
              <p class="text-white-75 mt-3">Our Purpose and Direction</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
        <!-- Vision Section -->
        <div class="bg-white rounded-lg shadow-lg p-8 transform hover:scale-105 transition-transform duration-300">
          <div class="text-center mb-6">
            <div class="inline-block p-4 rounded-full bg-blue-100 mb-4">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
              </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Vision</h2>
            <div class="text-lg text-gray-700 leading-relaxed">
              <p>To be a leading academic institution committed to excellence in education, transforming students into globally competitive and morally upright individuals.</p>
            </div>
          </div>
        </div>

        <!-- Mission Section -->
        <div class="bg-white rounded-lg shadow-lg p-8 transform hover:scale-105 transition-transform duration-300">
          <div class="text-center mb-6">
            <div class="inline-block p-4 rounded-full bg-green-100 mb-4">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
              </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Mission</h2>
            <div class="text-lg text-gray-700 leading-relaxed">
              <p>To provide quality education through innovative teaching methods, fostering academic excellence, Christian values, and leadership skills in our students.</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Core Values Integration -->
      <div class="mt-16">
        <div class="text-center mb-12">
          <h3 class="text-2xl font-bold text-gray-900">Guided by Our Core Values</h3>
          <p class="text-gray-600 mt-2">Everything we do is rooted in these fundamental principles</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
          <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <div class="inline-block p-3 rounded-full bg-red-100 mb-4">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
              </svg>
            </div>
            <h4 class="font-semibold text-gray-900">Faith</h4>
            <p class="text-gray-600 text-sm mt-2">Strengthening spiritual growth and Christian values</p>
          </div>
          <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <div class="inline-block p-3 rounded-full bg-blue-100 mb-4">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
              </svg>
            </div>
            <h4 class="font-semibold text-gray-900">Excellence</h4>
            <p class="text-gray-600 text-sm mt-2">Pursuing the highest standards in education</p>
          </div>
          <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <div class="inline-block p-3 rounded-full bg-yellow-100 mb-4">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
              </svg>
            </div>
            <h4 class="font-semibold text-gray-900">Leadership</h4>
            <p class="text-gray-600 text-sm mt-2">Developing future leaders with integrity</p>
          </div>
          <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <div class="inline-block p-3 rounded-full bg-green-100 mb-4">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
              </svg>
            </div>
            <h4 class="font-semibold text-gray-900">Innovation</h4>
            <p class="text-gray-600 text-sm mt-2">Embracing new ideas and methods</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.inner-banner {
  background-position: center;
  padding: 80px 0;
  position: relative;
}

.bg-overlay-black-70::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.7);
}

.inner-banner .container {
  position: relative;
  z-index: 1;
}

.text-white-75 {
  color: rgba(255, 255, 255, 0.75);
}
</style>