console.log('hello script.js')

console.log('hello jqerry.js')

function checkPasswords() {
	const password = document.getElementById('password').value
	const confirmPassword = document.getElementById('password_confirm').value
	const errorMessage = document.getElementById('errorMessage')

	if (password !== confirmPassword) {
		errorMessage.textContent = 'Пароли не совпадают.'
	} else {
		errorMessage.textContent = ''
	}
}
