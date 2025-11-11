const express = require('express');
const router = express.Router();
const fs = require('fs');
const path = require('path');

const eventsPath = path.join(__dirname, '../data/events.json');

// Get all events
router.get('/', (req, res) => {
  try {
    const events = JSON.parse(fs.readFileSync(eventsPath, 'utf8'));
    res.json(events);
  } catch (error) {
    res.status(500).json({ error: 'Error loading events' });
  }
});

// Add new event
router.post('/', (req, res) => {
  try {
    const events = JSON.parse(fs.readFileSync(eventsPath, 'utf8'));
    const newEvent = {
      id: Date.now().toString(),
      ...req.body
    };
    events.push(newEvent);
    fs.writeFileSync(eventsPath, JSON.stringify(events, null, 2));
    res.json(newEvent);
  } catch (error) {
    res.status(500).json({ error: 'Error creating event' });
  }
});

// Update event
router.put('/:id', (req, res) => {
  try {
    const events = JSON.parse(fs.readFileSync(eventsPath, 'utf8'));
    const index = events.findIndex(event => event.id === req.params.id);
    if (index === -1) {
      return res.status(404).json({ error: 'Event not found' });
    }
    events[index] = { ...events[index], ...req.body };
    fs.writeFileSync(eventsPath, JSON.stringify(events, null, 2));
    res.json(events[index]);
  } catch (error) {
    res.status(500).json({ error: 'Error updating event' });
  }
});

// Delete event
router.delete('/:id', (req, res) => {
  try {
    const events = JSON.parse(fs.readFileSync(eventsPath, 'utf8'));
    const filtered = events.filter(event => event.id !== req.params.id);
    fs.writeFileSync(eventsPath, JSON.stringify(filtered, null, 2));
    res.json({ message: 'Event deleted' });
  } catch (error) {
    res.status(500).json({ error: 'Error deleting event' });
  }
});

module.exports = router;