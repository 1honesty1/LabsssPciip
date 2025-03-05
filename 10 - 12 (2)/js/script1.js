// 4. Работа с предметом Математика
function calculateSphereVolume(radius) {
	if (radius < 0) {
		throw new Error('Радиус не может быть отрицательным')
	}
	return (4 / 3) * Math.PI * Math.pow(radius, 3)
}

function calculateVolume() {
	try {
		let radius = prompt('Введите радиус шара:')
		radius = parseFloat(radius)
		if (isNaN(radius)) {
			throw new Error('Введено не число')
		}
		let volume = calculateSphereVolume(radius)
		document.getElementById('sphereVolume').innerText =
			'Объем шара с радиусом ' + radius + ' равен ' + volume.toFixed(2)
	} catch (error) {
		alert('Ошибка: ' + error.message)
	}
}
