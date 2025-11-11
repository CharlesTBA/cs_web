const express = require('express');
const fs = require('fs').promises;
const path = require('path');

const router = express.Router();
const studentsFilePath = path.join(__dirname, '../data/students.json');

// Get all students (admin only)
router.get('/', async (req, res) => {
  try {
    const data = await fs.readFile(studentsFilePath, 'utf8');
    const { students } = JSON.parse(data);
    // return id and names for admin listings
    const list = students.map(s => ({ id: s.id, firstName: s.firstName, lastName: s.lastName, name: `${(s.firstName||'').trim()} ${(s.lastName||'').trim()}`.trim() }));
    res.json(list);
  } catch (error) {
    res.status(500).json({ error: 'Error reading students data' });
  }
});

// Register new student
router.post('/register', async (req, res) => {
  try {
    const { studentId, lastName, firstName } = req.body;
    
    if (!studentId || !lastName || !firstName) {
      return res.status(400).json({ error: 'All fields are required' });
    }

    // Validate student ID format (e.g., 53452023)
    if (!/^\d{8}$/.test(studentId)) {
      return res.status(400).json({ error: 'Student ID must be 8 digits' });
    }

    const data = await fs.readFile(studentsFilePath, 'utf8');
    const { students } = JSON.parse(data);

    // Check if student ID already exists
    if (students.some(s => s.id === studentId)) {
      return res.status(400).json({ error: 'Student ID already exists' });
    }

    // Add new student
    students.push({
      id: studentId,
      password: lastName,
      firstName,
      lastName,
      grades: [],
      subjects: []
    });

    await fs.writeFile(studentsFilePath, JSON.stringify({ students }, null, 2));
    res.status(201).json({ message: 'Student registered successfully' });
  } catch (error) {
    res.status(500).json({ error: 'Error registering student' });
  }
});

// Login
router.post('/login', async (req, res) => {
  try {
    const { studentId, password } = req.body;
    const data = await fs.readFile(studentsFilePath, 'utf8');
    const { students } = JSON.parse(data);

    const student = students.find(s => s.id === studentId && s.password === password);
    
    if (!student) {
      return res.status(401).json({ error: 'Invalid credentials' });
    }

    res.json({
      id: student.id,
      firstName: student.firstName,
      lastName: student.lastName
    });
  } catch (error) {
    res.status(500).json({ error: 'Error during login' });
  }
});

// Delete student (admin)
router.delete('/:id', async (req, res) => {
  try {
    const id = req.params.id;
    const raw = await fs.readFile(studentsFilePath, 'utf8');
    const data = JSON.parse(raw);
    const originalLength = data.students.length;
    data.students = data.students.filter(s => s.id !== id);
    if (data.students.length === originalLength) {
      return res.status(404).json({ error: 'Student not found' });
    }
    await fs.writeFile(studentsFilePath, JSON.stringify(data, null, 2));
    res.json({ message: 'Student deleted' });
  } catch (error) {
    res.status(500).json({ error: 'Error deleting student' });
  }
});

// Update student (admin)
router.put('/:id', async (req, res) => {
  try {
    const id = req.params.id;
    const { firstName, lastName, password } = req.body;
    const raw = await fs.readFile(studentsFilePath, 'utf8');
    const data = JSON.parse(raw);
    const idx = data.students.findIndex(s => s.id === id);
    if (idx === -1) return res.status(404).json({ error: 'Student not found' });
    if (firstName !== undefined) data.students[idx].firstName = firstName;
    if (lastName !== undefined) data.students[idx].lastName = lastName;
    if (password !== undefined) data.students[idx].password = password;
    await fs.writeFile(studentsFilePath, JSON.stringify(data, null, 2));
    res.json({ message: 'Student updated', student: data.students[idx] });
  } catch (error) {
    res.status(500).json({ error: 'Error updating student' });
  }
});

module.exports = router;