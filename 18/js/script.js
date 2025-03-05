document
	.getElementById('userForm')
	.addEventListener('submit', function (event) {
		event.preventDefault() // Отменяем стандартное поведение формы

		// Получаем значения полей
		const name = document.getElementById('name').value
		const email = document.getElementById('email').value
		const phone = document.getElementById('phone').value
		const agreement = document.getElementById('agreement').checked
		const gender = document.querySelector('input[name="gender"]:checked')
			? document.querySelector('input[name="gender"]:checked').value
			: 'не указан'
		const country = document.getElementById('country').value

		// Валидация имени
		if (!name) {
			alert('Имя не должно быть пустым')
			return
		}

		// Валидация электронной почты с регулярным выражением
		const emailPattern = /^[^@\s]+@[^@\s]+\.[^@\s]+$/
		if (!emailPattern.test(email)) {
			alert('Введите корректный адрес электронной почты.')
			return
		}

		// Валидация телефона с регулярным выражением
		const phonePattern = /^\+?[0-9]{1,15}$/
		if (!phonePattern.test(phone)) {
			alert('Введите корректный номер телефона.')
			return
		}

		// Проверка согласия
		if (!agreement) {
			alert('Необходимо согласие с условиями.')
			return
		}

		// Пример использования методов RegExp
		const regex = /[A-Za-z]/ // Регулярное выражение для проверки наличия букв
		console.log(`Имя содержит буквы: ${regex.test(name)}`) // test() проверяет, есть ли буквы в имени

		// Пример exec()
		const match = regex.exec(name)
		if (match) {
			console.log(`Первая буква в имени: ${match[0]}`) // exec() возвращает массив совпадений
		}

		// Примеры методов строки
		const text = 'Пример: 1234, пример текста!'

		// split() - разбивает строку на массив подстрок
		const words = text.split(/[\s,]+/)
		console.log('Слова в строке:', words)

		// match() - находит совпадения
		const found = text.match(/\d+/g)
		console.log('Найденные числа:', found)

		// search() - ищет совпадение и возвращает индекс первого найденного
		const index = text.search(/\d+/)
		console.log('Индекс первого числа:', index)

		// replace() - заменяет первое совпадение
		const replaced = text.replace(/\d+/, 'замена')
		console.log('После замены:', replaced)

		// Вывод данных в диалоговое окно
		alert(
			`Имя: ${name}\nЭлектронная почта: ${email}\nТелефон: ${phone}\nСогласие: ${agreement}\nПол: ${gender}\nСтрана: ${country}`
		)
	})
