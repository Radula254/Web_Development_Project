const express = require('express')
const bodyParser = require('body-parser')
const cors = require('cors')
const mysql = require('mysql')
const port = 3000
const path = require('path')


//app.use('/images', express.static(path.join(__dirname, 'images')));


const db = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'nurse',
})

db.connect((err) => {
  if (err) {
    console.log('Database connection error: ' + err.message);
  } else {
    console.log('Connected to the database');
  }
})
const app = express()

app.use(cors())
app.use(bodyParser.urlencoded({ extended: true }))
app.use(bodyParser.json())
// CRUD operations for receptionists table
//app.use('/receptionists', require('./main'))

//CRUD operations for drug categories
app.use('/drugdetail', require('./drugs.js'))

app.listen(port, () => {
  console.log(`Server is running on port ${port}`);
})