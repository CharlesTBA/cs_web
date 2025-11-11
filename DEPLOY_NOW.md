# 🚀 QUICK DEPLOYMENT TO GITHUB PAGES

## For Your Teacher Presentation

You need to deploy TWO things:
1. **Frontend** (Vue.js app) → GitHub Pages
2. **Backend** (Express API) → External hosting (Vercel/Heroku/etc.)

---

## ⚡ Quick Start: 3 Easy Steps

### STEP 1: Deploy Frontend to GitHub Pages (5 minutes)

Run this command from your project root:

```powershell
# PowerShell (Windows)
.\deploy.ps1
```

OR

```bash
# Git Bash or Terminal
bash -c "cd frontend && npm run build && cd .. && git add . && git commit -m 'Deploy: frontend to GitHub Pages' && git push origin main"
```

**What happens:**
- ✅ Builds your Vue app
- ✅ Pushes to GitHub
- ✅ GitHub Actions automatically deploys to GitHub Pages
- ✅ Available in 2-3 minutes at: **https://charlestba.github.io/cs_web/**

---

### STEP 2: Deploy Backend to Vercel (10 minutes)

**Vercel is FREE and requires NO credit card:**

1. Go to https://vercel.com
2. Click "Sign up" → "Continue with GitHub"
3. Authorize and connect your GitHub account
4. Click "Add New..." → "Project"
5. Find and select `cs_web` repository
6. Click "Import"
7. **Configure:**
   - **Root Directory:** `backend`
   - **Build Command:** `npm install`
   - **Start Command:** `node server.js`
8. Click "Deploy"
9. **COPY YOUR BACKEND URL** (e.g., `https://cs-web-api.vercel.app`)

---

### STEP 3: Connect Frontend to Backend (2 minutes)

1. Edit `frontend/src/config/api.js`:

```javascript
export const getApiBaseUrl = () => {
  if (window.location.hostname === 'charlestba.github.io') {
    // Replace with your Vercel backend URL
    return 'https://cs-web-api.vercel.app'  // ← PASTE YOUR VERCEL URL HERE
  }
  return 'http://localhost:3000'
}
```

2. Deploy updated frontend:

```bash
cd frontend
npm run build
cd ..
git add .
git commit -m "Update: connect to deployed backend"
git push origin main
```

**Done!** Your app is now live at **https://charlestba.github.io/cs_web/** 🎉

---

## ✅ Testing Your Deployment

1. **Visit Frontend:** https://charlestba.github.io/cs_web/
2. **Open Browser Console:** Press `F12` → Click "Console" tab
3. **Test Backend Connection:**
   - Try clicking a button that fetches data
   - Check console for errors
   - Should see API calls to your Vercel URL

---

## 🔧 Troubleshooting

### Blank White Page?
- **Check Console (F12):** Look for red error messages
- **Most common cause:** Backend URL not updated
- **Solution:** Update `frontend/src/config/api.js` with correct Vercel URL

### API Not Working / CORS Error?
- **Cause:** Backend CORS not configured for GitHub Pages
- **Solution:** Backend already configured - make sure Vercel deployment is live

### GitHub Pages Not Updating?
- Go to: https://github.com/CharlesTBA/cs_web/actions
- Check if the Deploy workflow is green (✅)
- If red (❌), click to see error details

### Vercel Deployment Failed?
- Go to: https://vercel.com/dashboard
- Click on project
- Check "Deployments" tab for error messages
- Common issue: `node_modules` might be required in root

---

## 📋 For Your Teacher

When presenting, you can show:

| Feature | Link |
|---------|------|
| **Main App** | https://charlestba.github.io/cs_web/ |
| **Student Login** | https://charlestba.github.io/cs_web/#/login |
| **Admin Dashboard** | https://charlestba.github.io/cs_web/#/admin-login |
| **Professor Panel** | https://charlestba.github.io/cs_web/#/professor-login |
| **API Health Check** | https://your-vercel-url.com/ |

---

## 🎯 Environment-Specific URLs

Your app automatically detects where it's running and uses the right API:

- **On GitHub Pages:** Uses Vercel backend
- **On `localhost:5173`:** Uses local `localhost:3000` backend
- **On `localhost:4173`:** Uses local `localhost:3000` backend

This means the same code works everywhere!

---

## ⏱️ Expected Deployment Times

- **Frontend Build:** 30-60 seconds
- **GitHub Actions Deploy:** 1-3 minutes (wait for green checkmark at Actions tab)
- **Vercel Build:** 2-5 minutes
- **Total Time to Live:** 3-10 minutes

---

## 💡 Pro Tips

1. **Test locally first:**
   ```bash
   npm run dev          # Test with local backend
   ```

2. **Test production build locally:**
   ```bash
   cd frontend && npm run build && npm run preview
   ```

3. **Monitor deployments:**
   - Frontend: https://github.com/CharlesTBA/cs_web/actions
   - Backend: https://vercel.com/dashboard

4. **Keep your GitHub updated:**
   ```bash
   git add .
   git commit -m "Your message"
   git push origin main
   ```

---

## 📞 If Something Goes Wrong

**Check these 3 things in this order:**

1. **Is the frontend deployed?**
   - Visit https://charlestba.github.io/cs_web/
   - See the page? ✅ Frontend is working

2. **Is the backend deployed?**
   - Visit your Vercel URL (e.g., https://cs-web-api.vercel.app/)
   - See "Holy Cross College Backend Running"? ✅ Backend is working

3. **Is the connection right?**
   - Open browser console (F12)
   - Try a feature that needs data
   - See error? Check `frontend/src/config/api.js` has correct Vercel URL

---

## 🎉 Once It's Live

Share this link with your teacher:
```
https://charlestba.github.io/cs_web/
```

It will work from any device, any network, anywhere! 🌍

---

**Need more help?** See `DEPLOYMENT.md` for detailed instructions.
