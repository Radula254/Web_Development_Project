const express = require('express');
const bodyParser = require('body-parser');
const cors = require('cors');
const mysql = require('mysql');

const app = express();
const port = 3000;
const path = require('path');


app.use(cors());
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));
app.use('/images', express.static(path.join(__dirname, 'images')));


const db = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'medease',
});

db.connect((err) => {
  if (err) {
    console.log('Database connection error: ' + err.message);
  } else {
    console.log('Connected to the database');
  }
});

// CRUD operations for receptionists table
app.use('/receptionists', require('./main'));

//CRUD operations for drug categories
app.use('/drugdetails', require('./drugs'));

app.listen(port, () => {
  console.log(`Server is running on port ${port}`);
});


