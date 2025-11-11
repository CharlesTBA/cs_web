// API Configuration
// This file determines the API base URL based on the environment

export const getApiBaseUrl = () => {
  // During GitHub Pages deployment
  if (window.location.hostname === 'charlestba.github.io' || 
      window.location.hostname === 'github.io') {
    // Use CORS-enabled backend API
    // For production, update this to your deployed backend URL
    return 'https://holy-cross-api.herokuapp.com' // Replace with your actual backend URL
  }
  
  // During local development
  return 'http://localhost:3000'
}

export const API_BASE_URL = getApiBaseUrl()
