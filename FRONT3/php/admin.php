<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'dispatcher') {
    header('Location: index.php');
    exit;
}

$user = $_SESSION['user'];

// Проверка, существует ли ключ 'id' в массиве
if (isset($user['id'])) {
    $userId = $user['id'];
    // Ваш код для работы с $userId
} else {
    // Обработка случая, когда 'id' не существует
    echo "Ошибка: пользователь не найден.";
    exit; // Завершаем выполнение скрипта
}

$stmt = $pdo->prepare("
    SELECT t.*, ts.name as status_name, u.name as executor_name, u.surname as executor_surname 
    FROM tasks t 
    JOIN task_status ts ON t.status_id = ts.id 
    LEFT JOIN users u ON t.executor_id = u.id 
    WHERE t.dispatcher_id = ?
    ORDER BY t.created_at DESC
");
$stmt->execute([$user['id']]);
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Обработка удаления задачи
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_task_id'])) {
    $stmt = $pdo->prepare("DELETE FROM tasks WHERE id = ? AND dispatcher_id = ?");
    $stmt->execute([$_POST['delete_task_id'], $user['id']]);
    header('Location: admin.php');
    exit;
}

// Отображаем шаблон
$html = file_get_contents('../templates/admin_template.html');
$html = str_replace('{{tasks}}', json_encode($tasks), $html);
echo eval('?>' . preg_replace('/\{\{(.*?)\}\}/', '<?php echo $1; ?>', $html) . '<?php');
?> 