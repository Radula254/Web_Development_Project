const express = ('express');
const app = express();

app.use((req, res, next) => {
    res.status(200).json({
        message: 'Welcome to the API'
    });
});

module.exports = app;