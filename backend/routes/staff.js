const express = require('express');
const fs = require('fs').promises;
const path = require('path');
const router = express.Router();

const adminsFilePath = path.join(__dirname, '../data/admins.json');
const professorsFilePath = path.join(__dirname, '../data/professors.json');

// Admin login
router.post('/admin/login', async (req, res) => {
  try {
    console.log('Received login request:', req.body);
    const { username, password } = req.body;
    
    // Validate request body
    if (!username || !password) {
      console.log('Missing credentials');
      return res.status(400).json({ error: 'Username and password are required' });
    }

    // Read and validate admins file
    let adminsData;
    try {
      const data = await fs.readFile(adminsFilePath, 'utf8');
      adminsData = JSON.parse(data);
      console.log('Admins data loaded:', adminsData);
    } catch (err) {
      console.error('Error reading admins file:', err);
      return res.status(500).json({ error: 'Internal server error' });
    }

    // Validate admin credentials
    const admin = adminsData.admins.find(a => a.username === username && a.password === password);
    console.log('Admin found:', admin);
    
    if (!admin) {
      return res.status(401).json({ error: 'Invalid credentials' });
    }

    // Send successful response and set cookie for cross-port session
    const response = {
      id: admin.id,
      name: admin.name,
      role: admin.role,
      type: 'admin'
    };
    console.log('Sending response:', response);

    // Set a cookie so pages served from http://localhost:3000 can read the session across ports
    // Note: for development this is a simple approach; for production use secure, httpOnly cookies and proper sessions/tokens
    res.cookie('user', JSON.stringify({ id: admin.id, role: admin.role, type: 'admin' }), {
      maxAge: 24 * 60 * 60 * 1000, // 1 day
      httpOnly: false,
      sameSite: 'lax'
    });

    return res.status(200).json(response);
  } catch (error) {
    console.error('Admin login error:', error);
    return res.status(500).json({ error: 'Login failed' });
  }
});

// Professor login
// Professor login
router.post('/professor/login', async (req, res) => {
  try {
    const { username, password } = req.body;
    if (!username || !password) {
      return res.status(400).json({ error: 'Username and password are required' });
    }
    // Read professors file
    let professorsData;
    try {
      const data = await fs.readFile(professorsFilePath, 'utf8');
      professorsData = JSON.parse(data);
    } catch (err) {
      console.error('Error reading professors file:', err);
      return res.status(500).json({ error: 'Internal server error' });
    }
    const professor = professorsData.professors.find(p => p.username === username && p.password === password);
    if (!professor) {
      return res.status(401).json({ error: 'Invalid professor credentials' });
    }
    // Set session cookie for professor
    res.cookie('user', JSON.stringify({ id: professor.id, role: 'professor', type: 'professor' }), {
      maxAge: 24 * 60 * 60 * 1000,
      httpOnly: false,
      sameSite: 'lax'
    });
    return res.status(200).json({
      id: professor.id,
      name: professor.name,
      department: professor.department,
      courses: professor.courses,
      type: 'professor'
    });
  } catch (error) {
    console.error('Professor login error:', error);
    return res.status(500).json({ error: 'Login failed' });
  }
});

// Get all professors (admin only)
router.get('/professors', async (req, res) => {
  try {
    const data = await fs.readFile(professorsFilePath, 'utf8');
    const { professors } = JSON.parse(data);
    res.json(professors.map(p => ({
      id: p.id,
      name: p.name,
      department: p.department,
      courses: p.courses
    })));
  } catch (error) {
    res.status(500).json({ error: 'Error fetching professors' });
  }
});

// Add new professor (admin only)
router.post('/professors', async (req, res) => {
  try {
    const { username, password, name, department, email } = req.body;
    
    if (!username || !password || !name || !department || !email) {
      return res.status(400).json({ error: 'All fields are required' });
    }

    const data = await fs.readFile(professorsFilePath, 'utf8');
    const { professors } = JSON.parse(data);
    
    if (professors.some(p => p.username === username)) {
      return res.status(400).json({ error: 'Username already exists' });
    }

    const newProfessor = {
      id: 'PROF' + String(professors.length + 1).padStart(3, '0'),
      username,
      password,
      name,
      department,
      email,
      courses: []
    };

    professors.push(newProfessor);
    await fs.writeFile(professorsFilePath, JSON.stringify({ professors }, null, 2));
    
    res.status(201).json({ 
      message: 'Professor added successfully',
      professor: {
        id: newProfessor.id,
        name: newProfessor.name,
        department: newProfessor.department
      }
    });
  } catch (error) {
    res.status(500).json({ error: 'Error adding professor' });
  }
});

// Update professor (admin or self)
router.put('/professors/:id', async (req, res) => {
  try {
    const { id } = req.params;
    const updates = req.body;
    const data = await fs.readFile(professorsFilePath, 'utf8');
    const { professors } = JSON.parse(data);
    
    const index = professors.findIndex(p => p.id === id);
    if (index === -1) {
      return res.status(404).json({ error: 'Professor not found' });
    }

    // Don't allow updating username or id
    delete updates.id;
    delete updates.username;

    professors[index] = { ...professors[index], ...updates };
    await fs.writeFile(professorsFilePath, JSON.stringify({ professors }, null, 2));
    
    res.json({
      message: 'Professor updated successfully',
      professor: {
        id: professors[index].id,
        name: professors[index].name,
        department: professors[index].department,
        courses: professors[index].courses
      }
    });
  } catch (error) {
    res.status(500).json({ error: 'Error updating professor' });
  }
});

// Delete professor (admin only)
router.delete('/professors/:id', async (req, res) => {
  try {
    const { id } = req.params;
    const data = await fs.readFile(professorsFilePath, 'utf8');
    const { professors } = JSON.parse(data);
    
    const filteredProfessors = professors.filter(p => p.id !== id);
    if (filteredProfessors.length === professors.length) {
      return res.status(404).json({ error: 'Professor not found' });
    }

    await fs.writeFile(professorsFilePath, JSON.stringify({ professors: filteredProfessors }, null, 2));
    res.json({ message: 'Professor deleted successfully' });
  } catch (error) {
    res.status(500).json({ error: 'Error deleting professor' });
  }
});

module.exports = router;