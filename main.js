const express = require('express');
const router = express.Router();
const mysql = require('mysql');

const db = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'medease',
});

// Get all receptionists
router.get('/', (req, res) => {
  db.query('SELECT * FROM receptionists', (err, result) => {
    if (err) {
      res.status(500).json({ error: err.message });
    } else {
      res.status(200).json(result);
    }
  });
});

// Get a specific receptionist by ID
router.get('/:id', (req, res) => {
  const receptionistId = req.params.id;
  db.query('SELECT * FROM receptionists WHERE id = ?', [receptionistId], (err, result) => {
    if (err) {
      res.status(500).json({ error: err.message });
    } else {
      res.status(200).json(result);
    }
  });
});

// Add a new receptionist
router.post('/', (req, res) => {
  const receptionist = req.body;
  db.query('INSERT INTO receptionists SET ?', receptionist, (err, result) => {
    if (err) {
      res.status(500).json({ error: err.message });
    } else {
      res.status(201).send('Receptionist added');
    }
  });
});

// Update a receptionist by ID
router.put('/:id', (req, res) => {
  const receptionistId = req.params.id;
  const updatedReceptionist = req.body;
  db.query('UPDATE receptionists SET ? WHERE id = ?', [updatedReceptionist, receptionistId], (err, result) => {
    if (err) {
      res.status(500).json({ error: err.message });
    } else {
      res.status(200).send('Receptionist updated');
    }
  });
});

// Delete a receptionist by ID
router.delete('/:id', (req, res) => {
  const receptionistId = req.params.id;
  db.query('DELETE FROM receptionists WHERE id = ?', [receptionistId], (err, result) => {
    if (err) {
      res.status(500).json({ error: err.message });
    } else {
      res.status(200).send('Receptionist deleted');
    }
  });
});

module.exports = router;
