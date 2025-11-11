const express = require('express');
const cors = require('cors');
const path = require('path');
const gradesRouter = require('./routes/grades');
const subjectsRouter = require('./routes/subjects');
const authRouter = require('./routes/auth');
const coursesRouter = require('./routes/courses');
const announcementsRouter = require('./routes/announcements');
const staffRouter = require('./routes/staff');
const newsRouter = require('./routes/news');
const eventsRouter = require('./routes/events');
const facultyRouter = require('./routes/faculty');

const app = express();

// Configure CORS for development
// Allow all localhost ports for development
app.use(cors({
  origin: [/^http:\/\/localhost:\d+$/, /^http:\/\/127\.0\.0\.1:\d+$/],
  credentials: true,
  methods: ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
  allowedHeaders: ['Origin', 'X-Requested-With', 'Content-Type', 'Accept']
}));

app.use(express.json());

// Handle malformed JSON body errors from body-parser and return JSON instead of HTML
app.use((err, req, res, next) => {
  if (err && err.type === 'entity.parse.failed') {
    console.error('JSON parse error:', err.message);
    return res.status(400).json({ error: 'Invalid JSON payload' });
  }
  // Some versions surface SyntaxError directly
  if (err instanceof SyntaxError && err.status === 400 && 'body' in err) {
    console.error('JSON parse SyntaxError:', err.message);
    return res.status(400).json({ error: 'Invalid JSON payload' });
  }
  next();
});

// Log all requests for debugging
app.use((req, res, next) => {
  console.log(`${req.method} ${req.path}`, req.body);
  next();
});

// Serve simple admin UI
app.use(express.static(path.join(__dirname, 'public')));

// CORS is now handled by the cors middleware above

// Routes
app.use('/api/auth', authRouter);
app.use('/api/grades', gradesRouter);
app.use('/api/subjects', subjectsRouter);
app.use('/api/courses', coursesRouter);
app.use('/api/announcements', announcementsRouter);
app.use('/api/staff', staffRouter);
app.use('/api/news', newsRouter);
app.use('/api/events', eventsRouter);
app.use('/api/faculty', facultyRouter);

app.get('/', (req, res) => res.send('Holy Cross College Backend Running'));

// Admin portal and subpaths — serve admin SPA
app.get(/^\/admin(\/.*)?$/, (req, res) => {
  res.sendFile(path.join(__dirname, 'public', 'admin', 'index.html'));
});

// Professor portal and subpaths — serve professor SPA
app.get(/^\/professor(\/.*)?$/, (req, res) => {
  res.sendFile(path.join(__dirname, 'public', 'professor', 'index.html'));
});

app.listen(3000, () => console.log('✅ Server running on http://localhost:3000'));

// Code to register a new student (for testing purposes)
// curl -X POST http://localhost:3000/api/auth/register \
//   -H "Content-Type: application/json" \
//   -d '{"studentId":"53452023","firstName":"John","lastName":"Smith"}'

// Code to add a new subject (for testing purposes)
// curl -X POST http://localhost:3000/api/subjects \
//   -H "Content-Type: application/json" \
//   -d '{"code":"MATH101","name":"Mathematics"}'

// Code to add a new grade (for testing purposes)
// curl -X POST http://localhost:3000/api/grades \
//   -H "Content-Type: application/json" \
//   -d '{"studentName":"John Smith","subjectId":1,"subjectName":"Mathematics","grade":95,"date":"2025-11-01"}'

// Code to delete a subject (for testing purposes)
// curl -X DELETE http://localhost:3000/api/subjects/1

// Code to delete a grade (for testing purposes)
// curl -X DELETE http://localhost:3000/api/grades/1
