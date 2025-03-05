document.addEventListener('click', function (event) {
	console.log('Кликнули по элементу:', event.target)
})

document.addEventListener('keydown', function (event) {
	console.log('Нажата клавиша:', event.key)
})

const dropArea = document.getElementById('drop-area')

dropArea.addEventListener('dragover', function (event) {
	event.preventDefault()
	dropArea.classList.add('drag-over')
})

dropArea.addEventListener('dragleave', function () {
	dropArea.classList.remove('drag-over')
})

dropArea.addEventListener('drop', function (event) {
	event.preventDefault()
	dropArea.classList.remove('drag-over')
	const files = event.dataTransfer.files
	console.log('Файлы, которые были перетащены:', files)
})
