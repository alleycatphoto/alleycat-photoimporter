const express = require('express');
const bodyParser = require('body-parser');
const fs = require('fs');
const path = require('path');

const app = express();
const port = 3000;

// Middleware
app.use(bodyParser.json());
app.use(express.static('public')); // Serve static files from the 'public' folder

// Example endpoint for file upload
app.post('/upload', (req, res) => {
  const { files } = req.body;
  fs.appendFileSync('./uploads/log.json', JSON.stringify(files, null, 2));
  res.status(200).send({ message: 'Files processed successfully.' });
});

app.listen(port, () => {
  console.log(`Server running at http://localhost:${port}`);
});
