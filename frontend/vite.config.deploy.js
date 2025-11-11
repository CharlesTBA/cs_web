import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

// Configuration for GitHub Pages deployment
// Base path must match the repository name
export default defineConfig({
  base: '/cs_web/',
  plugins: [vue()],
})
