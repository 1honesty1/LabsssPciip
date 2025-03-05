<?php
require 'config.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['password_confirm'];
    $role = $_POST['role'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        $message = "Пользователь с таким email уже существует.";
    } else {
        if ($password !== $confirmPassword) {
            $message = "Пароли не совпадают.";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (name, surname, email, password, role) VALUES (?, ?, ?, ?, ?)");
            if ($stmt->execute([$name, $surname, $email, $hashedPassword, $role])) {
                $userId = $pdo->lastInsertId();

                session_start();
                $_SESSION['user'] = [
                    'id' => $userId,
                    'name' => $name,
                    'surname' => $surname,
                    'email' => $email,
                    'role' => $role
                ];
                
                setcookie('user_name', $name, time() + (86400 * 30), "/"); // 30 дней
                setcookie('user_surname', $surname, time() + (86400 * 30), "/"); // 30 дней
                
                // Отладочное сообщение
                error_log("Пользователь зарегистрирован: ID = $userId");
                
                header('Location: home.php');
                exit;
            } else {
                $message = "Ошибка регистрации. Попробуйте снова.";
            }
        }
    }
}

// Передача данных в шаблон
$html = file_get_contents('../templates/register_form.html');
$html = str_replace('{{message}}', htmlspecialchars($message), $html);
echo $html;
?>
