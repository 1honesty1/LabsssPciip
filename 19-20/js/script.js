// Загрузка товаров из JSON-файла
async function loadProducts() {
	const response = await fetch('products.json')
	const products = await response.json()
	displayProducts(products)
}

// Отображение товаров на странице
function displayProducts(products) {
	const productContainer = document.getElementById('product-list')
	productContainer.innerHTML = '' // Очистка контейнера

	products.forEach(product => {
		const productDiv = document.createElement('div')
		productDiv.classList.add('product')
		productDiv.innerHTML = `
            <img src="${product.image}" alt="${product.name}">
            <h3>${product.name}</h3>
            <p>${product.description}</p>
            <p>Цена: $${product.price.toFixed(2)}</p>
            <button onclick="addToCart(${
							product.id
						})">Добавить в корзину</button>
        `
		productContainer.appendChild(productDiv)
	})
}

// Корзина
let cart = []

// Добавление товара в корзину
function addToCart(productId) {
	const product = cart.find(item => item.id === productId)
	if (product) {
		product.quantity++
	} else {
		cart.push({ id: productId, quantity: 1 })
	}
	console.log('Корзина:', cart)
}

// Работа с Local Storage
document
	.getElementById('user-form')
	.addEventListener('submit', function (event) {
		event.preventDefault()
		const fullName = document.getElementById('fullName').value
		const email = document.getElementById('email').value
		const birthDate = document.getElementById('birthDate').value
		const birthPlace = document.getElementById('birthPlace').value
		const hobbies = document.getElementById('hobbies').value

		// Установка данных в Local Storage
		localStorage.setItem('fullName', fullName)
		localStorage.setItem('email', email)
		localStorage.setItem('birthDate', birthDate)
		localStorage.setItem('birthPlace', birthPlace)
		localStorage.setItem('hobbies', hobbies)

		alert('Данные сохранены в Local Storage!')
	})

// Получение данных из Local Storage
function getLocalStorageData() {
	console.log('ФИО:', localStorage.getItem('fullName'))
	console.log('Email:', localStorage.getItem('email'))
	console.log('Дата рождения:', localStorage.getItem('birthDate'))
	console.log('Место рождения:', localStorage.getItem('birthPlace'))
	console.log('Увлечения:', localStorage.getItem('hobbies'))
}

// Вызываем функцию для получения данных из Local Storage
getLocalStorageData()

// Очистка Local Storage (при необходимости)
// function clearLocalStorage() {
//     localStorage.clear();
// }

// Пример очистки
// clearLocalStorage();

// Вызов функции загрузки товаров
loadProducts()