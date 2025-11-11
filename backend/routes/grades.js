const express = require('express')
const fs = require('fs')
const path = require('path')
const router = express.Router()

const DATA_PATH = path.join(__dirname, '..', 'data', 'grades.json')

function readData() {
  return JSON.parse(fs.readFileSync(DATA_PATH, 'utf8'))
}
function writeData(data) {
  fs.writeFileSync(DATA_PATH, JSON.stringify(data, null, 2))
}

// GET /api/grades
router.get('/', (req, res) => {
  const grades = readData()
  res.json(grades)
})

// GET /api/grades/:id
router.get('/:id', (req, res) => {
  const grades = readData()
  const id = Number(req.params.id)
  const found = grades.find(g => g.id === id)
  if (!found) return res.status(404).json({ error: 'Not found' })
  res.json(found)
})

// POST /api/grades
router.post('/', (req, res) => {
  const grades = readData()
  const { studentName, subjectId, subjectName, grade, date } = req.body
  if (!studentName || !subjectId || grade == null) return res.status(400).json({ error: 'Missing fields' })
  const id = grades.length ? Math.max(...grades.map(g => g.id)) + 1 : 1
  const newItem = { id, studentName, subjectId, subjectName: subjectName || '', grade, date: date || new Date().toISOString().slice(0,10) }
  grades.push(newItem)
  writeData(grades)
  res.status(201).json(newItem)
})

// PUT /api/grades/:id
router.put('/:id', (req, res) => {
  const grades = readData()
  const id = Number(req.params.id)
  const idx = grades.findIndex(g => g.id === id)
  if (idx === -1) return res.status(404).json({ error: 'Not found' })
  const updated = { ...grades[idx], ...req.body, id }
  grades[idx] = updated
  writeData(grades)
  res.json(updated)
})

// DELETE /api/grades/:id
router.delete('/:id', (req, res) => {
  let grades = readData()
  const id = Number(req.params.id)
  const newList = grades.filter(g => g.id !== id)
  if (newList.length === grades.length) return res.status(404).json({ error: 'Not found' })
  writeData(newList)
  res.status(204).end()
})

module.exports = router
