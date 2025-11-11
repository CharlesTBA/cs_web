const express = require('express');
const router = express.Router();
const fs = require('fs');
const path = require('path');

const newsPath = path.join(__dirname, '../data/news.json');

// Get all news
router.get('/', (req, res) => {
  try {
    const news = JSON.parse(fs.readFileSync(newsPath, 'utf8'));
    res.json(news);
  } catch (error) {
    res.status(500).json({ error: 'Error loading news' });
  }
});

// Add new news item
router.post('/', (req, res) => {
  try {
    const news = JSON.parse(fs.readFileSync(newsPath, 'utf8'));
    const newItem = {
      id: Date.now().toString(),
      date: new Date().toISOString(),
      ...req.body
    };
    news.push(newItem);
    fs.writeFileSync(newsPath, JSON.stringify(news, null, 2));
    res.json(newItem);
  } catch (error) {
    res.status(500).json({ error: 'Error creating news item' });
  }
});

// Update news item
router.put('/:id', (req, res) => {
  try {
    const news = JSON.parse(fs.readFileSync(newsPath, 'utf8'));
    const index = news.findIndex(item => item.id === req.params.id);
    if (index === -1) {
      return res.status(404).json({ error: 'News item not found' });
    }
    news[index] = { ...news[index], ...req.body };
    fs.writeFileSync(newsPath, JSON.stringify(news, null, 2));
    res.json(news[index]);
  } catch (error) {
    res.status(500).json({ error: 'Error updating news item' });
  }
});

// Delete news item
router.delete('/:id', (req, res) => {
  try {
    const news = JSON.parse(fs.readFileSync(newsPath, 'utf8'));
    const filtered = news.filter(item => item.id !== req.params.id);
    fs.writeFileSync(newsPath, JSON.stringify(filtered, null, 2));
    res.json({ message: 'News item deleted' });
  } catch (error) {
    res.status(500).json({ error: 'Error deleting news item' });
  }
});

module.exports = router;