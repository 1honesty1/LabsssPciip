<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'dispatcher') {
    header('Location: index.php');
    exit;
}

$user = $_SESSION['user'];

// Обработка редактирования задачи
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task_id'], $_POST['task_title'])) {
    $task_id = $_POST['task_id'];
    $task_title = $_POST['task_title'];

    $stmt = $pdo->prepare("UPDATE tasks SET title = ? WHERE id = ? AND dispatcher_id = ?");
    $stmt->execute([$task_title, $task_id, $user['id']]);

    // Записываем данные в текстовый файл
    $log_entry = date('Y-m-d H:i:s') . " - Задача ID: $task_id, Название: $task_title\n";
    file_put_contents('task_edit_log.txt', $log_entry, FILE_APPEND);

    header('Location: admin.php');
    exit;
}

// Получаем задачу для редактирования
if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = ? AND dispatcher_id = ?");
    $stmt->execute([$_GET['id'], $user['id']]);
    $task = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$task) {
        header('Location: admin.php');
        exit;
    }
} else {
    header('Location: admin.php');
    exit;
}

// Отображаем шаблон
$html = file_get_contents('../templates/edit_task_template.html');
$html = str_replace('{{task_title}}', htmlspecialchars($task['title']), $html);
$html = str_replace('{{task_id}}', htmlspecialchars($task['id']), $html);
$html = str_replace('{{user_email}}', htmlspecialchars($user['email']), $html);
echo $html;
?> 