const express = require('express');
const fs = require('fs').promises;
const path = require('path');

const router = express.Router();
const announcementsFilePath = path.join(__dirname, '../data/announcements.json');

// Get all announcements
router.get('/', async (req, res) => {
  try {
    const data = await fs.readFile(announcementsFilePath, 'utf8');
    const { announcements } = JSON.parse(data);
    res.json(announcements);
  } catch (error) {
    res.status(500).json({ error: 'Error reading announcements data' });
  }
});

// Get recent announcements
router.get('/recent', async (req, res) => {
  try {
    const data = await fs.readFile(announcementsFilePath, 'utf8');
    const { announcements } = JSON.parse(data);
    const recentAnnouncements = announcements
      .sort((a, b) => new Date(b.date) - new Date(a.date))
      .slice(0, 5);
    res.json(recentAnnouncements);
  } catch (error) {
    res.status(500).json({ error: 'Error reading announcements data' });
  }
});

// Create a new announcement
router.post('/', async (req, res) => {
  try {
    const body = req.body || {}
    if (!body.title || !body.content) {
      return res.status(400).json({ error: 'title and content are required' })
    }

    const file = await fs.readFile(announcementsFilePath, 'utf8')
    const data = JSON.parse(file)
    const announcements = Array.isArray(data.announcements) ? data.announcements : []
    const maxId = announcements.reduce((m, a) => Math.max(m, a.id || 0), 0)
    const newAnn = {
      id: maxId + 1,
      title: body.title,
      content: body.content,
      date: body.date || new Date().toISOString().slice(0,10),
      type: body.type || 'general'
    }
    announcements.push(newAnn)
    await fs.writeFile(announcementsFilePath, JSON.stringify({ announcements }, null, 2), 'utf8')
    res.status(201).json(newAnn)
  } catch (err) {
    console.error('Error creating announcement:', err)
    res.status(500).json({ error: 'Error creating announcement' })
  }
})

// Update an announcement
router.put('/:id', async (req, res) => {
  try {
    const id = Number(req.params.id)
    const body = req.body || {}
    const file = await fs.readFile(announcementsFilePath, 'utf8')
    const data = JSON.parse(file)
    const announcements = Array.isArray(data.announcements) ? data.announcements : []
    const idx = announcements.findIndex(a => Number(a.id) === id)
    if (idx === -1) return res.status(404).json({ error: 'Announcement not found' })
    announcements[idx] = { ...announcements[idx], ...body, id }
    await fs.writeFile(announcementsFilePath, JSON.stringify({ announcements }, null, 2), 'utf8')
    res.json(announcements[idx])
  } catch (err) {
    console.error('Error updating announcement:', err)
    res.status(500).json({ error: 'Error updating announcement' })
  }
})

// Delete an announcement
router.delete('/:id', async (req, res) => {
  try {
    const id = Number(req.params.id)
    const file = await fs.readFile(announcementsFilePath, 'utf8')
    const data = JSON.parse(file)
    const announcements = Array.isArray(data.announcements) ? data.announcements : []
    const filtered = announcements.filter(a => Number(a.id) !== id)
    if (filtered.length === announcements.length) return res.status(404).json({ error: 'Announcement not found' })
    await fs.writeFile(announcementsFilePath, JSON.stringify({ announcements: filtered }, null, 2), 'utf8')
    res.json({ success: true })
  } catch (err) {
    console.error('Error deleting announcement:', err)
    res.status(500).json({ error: 'Error deleting announcement' })
  }
})

module.exports = router;