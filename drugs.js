const express = require('express');
const router = express.Router();
const mysql = require('mysql');

const db = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'medease',
});

// Get all drugs
router.get('/', (req, res) => {
  db.query('SELECT * FROM drugdetails', (err, result) => {
    if (err) {
      res.status(500).json({ error: err.message });
    } else {
      res.status(200).json(result);
    }
  });
});


// Get a specific drug by ID
router.get('/:id', (req, res) => {
  const drugId = req.params.id;
  db.query('SELECT * FROM drugdetails WHERE id = ?', [drugId], (err, result) => {
    if (err) {
      res.status(500).json({ error: err.message });
    } else {
      res.status(200).json(result);
    }
  });
});

router.post('/', (req, res) => {
  const drugs = req.body;
  db.query('INSERT INTO drugdetails SET ?', drugs, (err, result) => {
    if (err) {
      res.status(500).json({ error: err.message });
    } else {
      res.status(201).send('drugs added');
    }
  });
});





  

  
// Update a drug by ID
router.put('/:id', (req, res) => {
  const drugId = req.params.id;
  const updateddrug = req.body;
  db.query('UPDATE drugdetails SET ? WHERE id = ?', [updateddrug, drugId], (err, result) => {
    if (err) {
      res.status(500).json({ error: err.message });
    } else {
      res.status(200).send('drug updated');
    }
  });
});

// Delete a drug by ID
router.delete('/:id', (req, res) => {
  const drugId = req.params.id;
  db.query('DELETE FROM drugdetails WHERE id = ?', [drugId], (err, result) => {
    if (err) {
      res.status(500).json({ error: err.message });
    } else {
      res.status(200).send('drug deleted');
    }
  });
});

module.exports = router;
