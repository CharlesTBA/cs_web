# Holy Cross College Portal - Full Stack Setup

This repository contains a complete full-stack application for Holy Cross College with:
- **Backend**: Express.js REST API (Node.js) on port 3000
- **Frontend**: Vue 3 + Vite SPA (TypeScript-ready) on port 5173

## Quick Start (All-in-One)

### Option 1: Run Everything with One Command

```bash
# From the root directory
npm install
npm run dev
```

This will automatically:
1. Install concurrently package
2. Start the backend server on `http://localhost:3000`
3. Start the frontend dev server on `http://localhost:5173`

Both will run in the same terminal with color-coded output:
- `[0]` = Backend (Express)
- `[1]` = Frontend (Vite)

### Option 2: Run Services Separately

**Terminal 1 - Backend:**
```bash
cd backend
npm install
npm run dev
```
Backend will be available at `http://localhost:3000`

**Terminal 2 - Frontend:**
```bash
cd frontend
npm install
npm run dev
```
Frontend will be available at `http://localhost:5173`

---

## Initial Setup

### First Time Setup
If you haven't installed dependencies yet, run:
```bash
npm run install-all
```

This will install dependencies in:
- Root directory (for concurrently)
- `backend/` folder
- `frontend/` folder

---

## Available Commands

### From Root Directory
```bash
npm run dev              # Run both backend and frontend concurrently (development)
npm run start            # Run backend + build & preview frontend (production-like)
npm run backend          # Run only backend
npm run frontend         # Run only frontend
npm run build            # Build frontend for production
npm run preview          # Preview production build
npm run install-all      # Install all dependencies (root, backend, frontend)
```

### Backend (Express)
```bash
cd backend
npm run dev              # Run backend in development
npm start                # Run backend (production)
```

### Frontend (Vue 3 + Vite)
```bash
cd frontend
npm run dev              # Run dev server with hot reload
npm run build            # Build for production
npm run preview          # Preview production build
```

---

## Architecture

### Backend Structure
```
backend/
├── server.js           # Main Express server
├── package.json        # Dependencies & scripts
├── routes/             # API endpoints
│   ├── auth.js
│   ├── grades.js
│   ├── subjects.js
│   ├── courses.js
│   ├── announcements.js
│   ├── staff.js
│   ├── news.js
│   ├── events.js
│   └── faculty.js
├── data/               # JSON data files (file-backed database)
└── public/             # Static files & admin/professor portals
    ├── admin/
    └── professor/
```

### Frontend Structure
```
frontend/
├── src/
│   ├── App.vue         # Root component
│   ├── main.js         # Entry point
│   ├── router/         # Vue Router configuration
│   ├── store/          # Pinia state management
│   ├── components/     # Reusable components
│   ├── views/          # Page components
│   ├── composables/    # Composition API logic
│   └── assets/         # Styles, images, etc.
├── vite.config.js      # Vite configuration
├── tailwind.config.cjs # Tailwind CSS config
└── package.json        # Dependencies & scripts
```

---

## API Endpoints

### Base URL: `http://localhost:3000/api`

**Authentication:**
- `POST /auth/login` - User login
- `POST /auth/register` - Register new student

**Grades:**
- `GET /grades` - Get all grades
- `POST /grades` - Add new grade
- `DELETE /grades/:id` - Delete grade

**Subjects:**
- `GET /subjects` - Get all subjects
- `POST /subjects` - Add new subject
- `DELETE /subjects/:id` - Delete subject

**Courses, Announcements, Staff, News, Events, Faculty** - Similar CRUD operations available.

---

## Frontend Features

- **Vue 3** with Composition API
- **Vue Router** for client-side navigation
- **Pinia** for state management
- **Axios** for API calls with CORS support
- **Tailwind CSS** for styling
- **Vite** for fast development and optimized builds

---

## CORS Configuration

The backend is configured to accept requests from:
- `http://localhost:*` (any port on localhost)
- `http://127.0.0.1:*` (any port on 127.0.0.1)

This allows the frontend (port 5173) to communicate with the backend (port 3000) during development.

---

## Troubleshooting

### Port Already in Use
If port 3000 or 5173 is already in use:

**For Backend (port 3000):**
Edit `backend/server.js` and change:
```javascript
app.listen(3000, () => console.log('✅ Server running on http://localhost:3000'));
```

**For Frontend (port 5173):**
Edit `frontend/vite.config.js` and add:
```javascript
export default {
  server: {
    port: 5174 // or any available port
  }
}
```

### Dependencies Not Installed
If you see errors about missing modules:
```bash
npm run install-all
```

### CORS Errors
Make sure both services are running and check the backend CORS settings in `backend/server.js`.

---

## Production Build

### Build Frontend
```bash
cd frontend
npm run build
```
Output will be in `frontend/dist/`

### Deploy
1. Build the frontend: `npm run build`
2. Copy `frontend/dist/` contents to a web server
3. Ensure frontend can reach backend API
4. Update API endpoints in frontend if backend URL changes

---

## Development Notes

- Backend runs on **port 3000** with file-backed JSON data
- Frontend runs on **port 5173** with hot module replacement (HMR)
- Both services have CORS configured to work together
- API data is stored in `backend/data/` as JSON files

Enjoy developing! 🚀
