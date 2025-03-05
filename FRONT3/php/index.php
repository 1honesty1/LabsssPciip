<?php
require 'config.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Проверяем пользователя по email
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    // Проверка пароля
    if ($user && password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['user'] = $user;
        header('Location: home.php');
        exit;
    } else {
        $message = "Неверный email или пароль.";
    }
}

// Передача сообщения об ошибке в шаблон
$html = file_get_contents('../templates/login_form.html');
$html = str_replace('{{message}}', htmlspecialchars($message), $html);
echo $html;
?>
