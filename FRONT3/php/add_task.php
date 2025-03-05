<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'dispatcher') {
    header('Location: index.php');
    exit;
}

$user = $_SESSION['user'];
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $executor_name = $_POST['executor_name'];
    $executor_surname = $_POST['executor_surname'];
    $task_description = $_POST['task_description'];

    $stmt = $pdo->prepare("SELECT id, email FROM users WHERE name = ? AND surname = ? AND role = 'executor'");
    $stmt->execute([$executor_name, $executor_surname]);
    $executor = $stmt->fetch();

    if ($executor) {
        $stmt = $pdo->prepare("INSERT INTO tasks (title, description, executor_id, dispatcher_id, status_id) VALUES (?, ?, ?, ?, 1)");
        if ($stmt->execute([$task_description, $task_description, $executor['id'], $user['id']])) {
            $subject = "Новая задача назначена";
            $message = "Вы получили новую задачу: $task_description. Пожалуйста, проверьте вашу панель задач.";
            mail($executor['email'], $subject, $message);

            $notification_stmt = $pdo->prepare("INSERT INTO notifications (user_id, message) VALUES (?, ?)");
            $notification_stmt->execute([$executor['id'], $message]);

            header('Location: home.php');
            exit;
        } else {
            $error = "Ошибка при добавлении задачи";
        }
    } else {
        $error = "Исполнитель не найден";
    }
}

$html = file_get_contents('../templates/add_task_template.html');
$html = str_replace('{{error}}', htmlspecialchars($error), $html);
echo eval('?>' . preg_replace('/\{\{(.*?)\}\}/', '<?php echo $1; ?>', $html) . '<?php');
?> 