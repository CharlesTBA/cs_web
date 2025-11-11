const express = require('express')
const fs = require('fs')
const path = require('path')
const router = express.Router()

const DATA_PATH = path.join(__dirname, '..', 'data', 'subjects.json')

function readData() {
  return JSON.parse(fs.readFileSync(DATA_PATH, 'utf8'))
}
function writeData(data) {
  fs.writeFileSync(DATA_PATH, JSON.stringify(data, null, 2))
}

router.get('/', (req, res) => {
  const subjects = readData()
  res.json(subjects)
})

router.get('/:id', (req, res) => {
  const subjects = readData()
  const id = Number(req.params.id)
  const found = subjects.find(s => s.id === id)
  if (!found) return res.status(404).json({ error: 'Not found' })
  res.json(found)
})

router.post('/', (req, res) => {
  const subjects = readData()
  const { name, code } = req.body
  if (!name || !code) return res.status(400).json({ error: 'Missing fields' })
  const id = subjects.length ? Math.max(...subjects.map(s => s.id)) + 1 : 1
  const item = { id, name, code }
  subjects.push(item)
  writeData(subjects)
  res.status(201).json(item)
})

router.put('/:id', (req, res) => {
  const subjects = readData()
  const id = Number(req.params.id)
  const idx = subjects.findIndex(s => s.id === id)
  if (idx === -1) return res.status(404).json({ error: 'Not found' })
  const updated = { ...subjects[idx], ...req.body, id }
  subjects[idx] = updated
  writeData(subjects)
  res.json(updated)
})

router.delete('/:id', (req, res) => {
  const subjects = readData()
  const id = Number(req.params.id)
  const newList = subjects.filter(s => s.id !== id)
  if (newList.length === subjects.length) return res.status(404).json({ error: 'Not found' })
  writeData(newList)
  res.status(204).end()
})

module.exports = router
