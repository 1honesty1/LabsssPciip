document.addEventListener('DOMContentLoaded', function () {
	const slides = document.querySelectorAll('.slide')
	const dotsContainer = document.querySelector('.slider-dots')

	// Создаем точки
	slides.forEach((_, index) => {
		const dot = document.createElement('div')
		dot.classList.add('dot')
		if (index === 0) dot.classList.add('active')
		dotsContainer.appendChild(dot)
	})

	// Обновляем активную точку
	setInterval(() => {
		const activeDot = document.querySelector('.dot.active')
		const nextDot =
			activeDot.nextElementSibling || dotsContainer.firstElementChild
		activeDot.classList.remove('active')
		nextDot.classList.add('active')
	}, 5000)
})
