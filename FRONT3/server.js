const express = require('express')
const app = express()
const PORT = process.env.PORT || 3005

app.get('/', (req, res) => {
	res.send('Hello World!')
})

app.listen(PORT, () => {
	console.log(`Сервер запущен на http://localhost:${PORT}`)
})
