// Функции для отображения секций
function showSection(sectionId) {
	const sections = document.querySelectorAll('section')
	sections.forEach(section => {
		section.style.display = 'none'
	})
	document.getElementById(sectionId).style.display = 'block'
}

// Обработка событий мыши
const box = document.getElementById('box')
box.addEventListener('mouseover', () => {
	box.style.backgroundColor = 'lightgreen'
})
box.addEventListener('mouseout', () => {
	box.style.backgroundColor = 'lightblue'
})
box.addEventListener('click', () => {
	alert('Бокс был кликнут!')
})

// Обработка событий клавиатуры
const textInput = document.getElementById('textInput')
const output = document.getElementById('output')
textInput.addEventListener('keydown', event => {
	output.textContent = `Вы нажали клавишу: ${event.key}`
})

// Обработка Drag & Drop событий
const draggable = document.getElementById('draggable')
const dropzone = document.getElementById('dropzone')
draggable.addEventListener('dragstart', event => {
	event.dataTransfer.setData('text/plain', 'Это перетаскиваемый элемент')
})
dropzone.addEventListener('dragover', event => {
	event.preventDefault()
})
dropzone.addEventListener('drop', event => {
	event.preventDefault()
	alert('Элемент был сброшен!')
})

// Обработка событий указателя
const pointerArea = document.getElementById('pointerArea')
pointerArea.addEventListener('pointerdown', () => {
	pointerArea.style.backgroundColor = 'lightblue'
})
pointerArea.addEventListener('pointerup', () => {
	pointerArea.style.backgroundColor = 'lightcoral'
	alert('Pointer event сработал!')
})

// Обработка событий прокрутки
window.addEventListener('scroll', () => {
	console.log('Страница прокручена на: ' + window.scrollY + 'px')
})

// Обработка событий сенсорных экранов
const touchArea = document.getElementById('touchArea')
touchArea.addEventListener('touchstart', () => {
	touchArea.style.backgroundColor = 'lightyellow'
})
touchArea.addEventListener('touchend', () => {
	touchArea.style.backgroundColor = 'lavender'
	alert('Косание завершено!')
})

// Обработка событий таймеров
let count = 0
const timerOutput = document.getElementById('timerOutput')
const timer = setInterval(() => {
	count++
	timerOutput.textContent = `Таймер: ${count}`
	if (count >= 10) {
		clearInterval(timer)
		alert('Таймер завершен!')
	}
}, 1000)

// Обработка меню-бургера
const burger = document.querySelector('.burger')
burger.addEventListener('click', () => {
	document.getElementById('navbar').classList.toggle('active')
})
