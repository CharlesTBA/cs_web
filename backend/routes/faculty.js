const express = require('express');
const router = express.Router();
const fs = require('fs');
const path = require('path');

const facultyPath = path.join(__dirname, '../data/faculty.json');

// Get all faculty members
router.get('/', (req, res) => {
  try {
    const faculty = JSON.parse(fs.readFileSync(facultyPath, 'utf8'));
    res.json(faculty);
  } catch (error) {
    res.status(500).json({ error: 'Error loading faculty data' });
  }
});

// Add new faculty member
router.post('/', (req, res) => {
  try {
    const faculty = JSON.parse(fs.readFileSync(facultyPath, 'utf8'));
    const newMember = {
      id: Date.now().toString(),
      ...req.body
    };
    faculty.push(newMember);
    fs.writeFileSync(facultyPath, JSON.stringify(faculty, null, 2));
    res.json(newMember);
  } catch (error) {
    res.status(500).json({ error: 'Error creating faculty member' });
  }
});

// Update faculty member
router.put('/:id', (req, res) => {
  try {
    const faculty = JSON.parse(fs.readFileSync(facultyPath, 'utf8'));
    const index = faculty.findIndex(member => member.id === req.params.id);
    if (index === -1) {
      return res.status(404).json({ error: 'Faculty member not found' });
    }
    faculty[index] = { ...faculty[index], ...req.body };
    fs.writeFileSync(facultyPath, JSON.stringify(faculty, null, 2));
    res.json(faculty[index]);
  } catch (error) {
    res.status(500).json({ error: 'Error updating faculty member' });
  }
});

// Delete faculty member
router.delete('/:id', (req, res) => {
  try {
    const faculty = JSON.parse(fs.readFileSync(facultyPath, 'utf8'));
    const filtered = faculty.filter(member => member.id !== req.params.id);
    fs.writeFileSync(facultyPath, JSON.stringify(filtered, null, 2));
    res.json({ message: 'Faculty member deleted' });
  } catch (error) {
    res.status(500).json({ error: 'Error deleting faculty member' });
  }
});

module.exports = router;