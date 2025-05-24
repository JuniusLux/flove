const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#password');

  togglePassword.addEventListener('click', function () {
    // Переключаем тип поля: password <-> text
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);

    // Меняем текст кнопки между 👁️ и 🔒 (по желанию)
    this.textContent = type === 'password' ? '👁️' : '🔒';
  });