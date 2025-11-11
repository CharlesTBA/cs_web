const express = require('express');
const fs = require('fs').promises;
const path = require('path');

const router = express.Router();
const coursesFilePath = path.join(__dirname, '../data/courses.json');

// Get all courses
router.get('/', async (req, res) => {
  try {
    const data = await fs.readFile(coursesFilePath, 'utf8');
    const { courses } = JSON.parse(data);
    res.json(courses);
  } catch (error) {
    res.status(500).json({ error: 'Error reading courses data' });
  }
});

// Get course by ID
router.get('/:id', async (req, res) => {
  try {
    const data = await fs.readFile(coursesFilePath, 'utf8');
    const { courses } = JSON.parse(data);
    const course = courses.find(c => c.id === parseInt(req.params.id));
    
    if (!course) {
      return res.status(404).json({ error: 'Course not found' });
    }
    
    res.json(course);
  } catch (error) {
    res.status(500).json({ error: 'Error reading course data' });
  }
});

// Get course assignments
router.get('/:id/assignments', async (req, res) => {
  try {
    const data = await fs.readFile(coursesFilePath, 'utf8');
    const { courses } = JSON.parse(data);
    const course = courses.find(c => c.id === parseInt(req.params.id));
    
    if (!course) {
      return res.status(404).json({ error: 'Course not found' });
    }
    
    res.json(course.assignments);
  } catch (error) {
    res.status(500).json({ error: 'Error reading assignments data' });
  }
});

module.exports = router;