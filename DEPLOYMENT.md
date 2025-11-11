# GitHub Pages & Backend Deployment Guide

## Overview

This guide shows how to deploy your Holy Cross College Portal to GitHub Pages and configure the backend for production.

---

## Part 1: Frontend Deployment to GitHub Pages

### Step 1: Build the Frontend

```bash
cd frontend
npm install
npm run build
```

This creates a `frontend/dist/` folder with production-ready files.

### Step 2: Push to GitHub

```bash
git add .
git commit -m "Build: prepare frontend for GitHub Pages deployment"
git push origin main
```

### Step 3: Enable GitHub Pages

1. Go to **GitHub Repository Settings** → **Pages**
2. Under "Build and deployment":
   - **Source**: Select "Deploy from a branch"
   - **Branch**: Select `gh-pages` (will be created by the workflow)
   - **Folder**: Select `/ (root)`
3. Click **Save**

Your site will be available at: `https://charlestba.github.io/cs_web/`

---

## Part 2: Automatic Deployment with GitHub Actions

### Step 1: Workflow Already Set Up

The `.github/workflows/deploy.yml` file is already configured to:
- Build your frontend automatically when you push to `main`
- Deploy to the `gh-pages` branch automatically

### Step 2: Just Push to Main

```bash
git push origin main
```

GitHub Actions will:
1. Install all dependencies
2. Build the frontend
3. Deploy to GitHub Pages automatically

---

## Part 3: Backend Deployment (Choose One Option)

### Option A: Deploy to Vercel (Recommended - Free & Easy)

**Vercel is perfect for Node.js apps:**

1. **Create a Vercel Account**
   - Go to https://vercel.com
   - Sign up with GitHub

2. **Connect Your GitHub Repository**
   - Click "New Project"
   - Select your `cs_web` repository
   - Vercel will auto-detect it's a monorepo

3. **Configure for Backend**
   - Set **Root Directory** to `backend`
   - Set **Build Command** to `npm install`
   - Set **Start Command** to `node server.js`

4. **Deploy**
   - Click "Deploy"
   - Your backend will be available at something like: `https://cs-web-api.vercel.app`

5. **Update Frontend API URL**
   - Edit `frontend/src/config/api.js`
   - Replace `https://holy-cross-api.herokuapp.com` with your Vercel URL

### Option B: Deploy to Heroku (Free Tier Ending - Paid Only)

1. Create account at https://heroku.com
2. Install Heroku CLI
3. Create app: `heroku create cs-web-api`
4. Set buildpack: `heroku buildpacks:set heroku/nodejs`
5. Deploy: `git push heroku main`

### Option C: Deploy to Railway (Easy & Affordable)

1. Go to https://railway.app
2. Sign up with GitHub
3. Create new project from GitHub repository
4. Set root directory to `backend`
5. Configure environment variables if needed
6. Deploy

---

## Part 4: Connect Frontend to Deployed Backend

### Update API Configuration

Edit `frontend/src/config/api.js`:

```javascript
export const getApiBaseUrl = () => {
  // GitHub Pages production
  if (window.location.hostname === 'charlestba.github.io') {
    return 'https://your-deployed-backend-url.com'  // Your deployed backend
  }
  
  // Local development
  return 'http://localhost:3000'
}
```

### Redeploy Frontend

```bash
cd frontend
npm run build
git add .
git commit -m "Update: backend API endpoint"
git push origin main
```

GitHub Actions will automatically rebuild and deploy to GitHub Pages.

---

## Part 5: Enable CORS on Backend

Make sure your backend has CORS enabled for your GitHub Pages URL:

Edit `backend/server.js`:

```javascript
app.use(cors({
  origin: [
    /^http:\/\/localhost:\d+$/,           // Local development
    /^http:\/\/127\.0\.0\.1:\d+$/,        // Local development
    'https://charlestba.github.io',       // Your GitHub Pages URL
    'https://your-backend-url.com'        // Your backend URL (if different domain)
  ],
  credentials: true,
  methods: ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
  allowedHeaders: ['Origin', 'X-Requested-With', 'Content-Type', 'Accept']
}));
```

---

## Final URLs

Once deployed:

| Component | URL |
|-----------|-----|
| **Frontend** | https://charlestba.github.io/cs_web/ |
| **Backend API** | https://your-backend.vercel.app/api/* |
| **Admin Panel** | https://charlestba.github.io/cs_web/#/admin-login |
| **Professor Panel** | https://charlestba.github.io/cs_web/#/professor-login |
| **Student Portal** | https://charlestba.github.io/cs_web/#/login |

---

## Troubleshooting

### Blank Page on GitHub Pages

**Solution:** Check browser console (F12 → Console tab) for:
- 404 errors → Files not deploying correctly
- CORS errors → Backend not accessible
- API errors → Backend URL incorrect

### API Calls Failing

**Likely causes:**
1. Backend not deployed
2. Backend URL not updated in `api.js`
3. CORS not enabled on backend
4. Backend server is down

**Debug:**
```bash
# In browser console
fetch('https://your-backend-url.com/api/subjects')
  .then(r => r.json())
  .then(d => console.log(d))
```

### GitHub Pages Not Updating

**Solution:**
1. Check `.github/workflows/deploy.yml` ran successfully
2. Go to repository → Actions tab
3. If workflow failed, check the error logs
4. Common issue: frontend not building → check `npm run build` locally

---

## Testing Before Presenting

1. **Test Frontend Locally:**
   ```bash
   npm run dev
   ```

2. **Test Production Build Locally:**
   ```bash
   cd frontend
   npm run build
   npm run preview
   # Visit http://localhost:4173/cs_web/
   ```

3. **Test on GitHub Pages:**
   - Visit https://charlestba.github.io/cs_web/
   - Open browser console (F12)
   - Check for errors
   - Test each feature

4. **Test Backend:**
   - Visit `https://your-backend-url.com/`
   - Should see "Holy Cross College Backend Running"

---

## One-Time Setup Summary

```bash
# 1. Build frontend
cd frontend && npm run build && cd ..

# 2. Commit and push
git add .
git commit -m "Deploy: frontend to GitHub Pages"
git push origin main

# 3. GitHub Actions runs automatically
# 4. Check https://charlestba.github.io/cs_web/

# 5. Deploy backend to Vercel/Heroku/Railway
# 6. Update api.js with backend URL
# 7. Rebuild and push
npm run build
git add . && git commit -m "Update: backend URL" && git push
```

That's it! Your app is live and ready to present! 🎉
