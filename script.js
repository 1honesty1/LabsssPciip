document.addEventListener('DOMContentLoaded', () => {
	const toggleButton = document.querySelector('.toggle-button')
	const navbarLinks = document.querySelector('.navbar-links')
	const brandTitle = document.querySelector('.brand-title')
	const body = document.querySelector('body')
	const main = document.querySelector('main')

	const toggleMenu = () => {
		navbarLinks.classList.toggle('active')
		body.classList.toggle('menu-active')
		main.classList.toggle('hidden')
	}

	toggleButton.addEventListener('click', toggleMenu)
	brandTitle.addEventListener('click', toggleMenu)
})
