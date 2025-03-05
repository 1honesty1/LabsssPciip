<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'executor') {
    header('Location: index.php');
    exit;
}

$user = $_SESSION['user'];

// Обновление статуса задачи, если пришел POST запрос
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task_id'], $_POST['status_id'])) {
    $stmt = $pdo->prepare("UPDATE tasks SET status_id = ? WHERE id = ? AND executor_id = ?");
    $stmt->execute([$_POST['status_id'], $_POST['task_id'], $user['id']]);
    header('Location: tasks.php');
    exit;
}

// Получаем задачи для текущего исполнителя
$stmt = $pdo->prepare("
    SELECT t.*, ts.name as status_name, 
           u.name as dispatcher_name, u.surname as dispatcher_surname
    FROM tasks t 
    JOIN task_status ts ON t.status_id = ts.id 
    JOIN users u ON t.dispatcher_id = u.id 
    WHERE t.executor_id = ?
    ORDER BY t.created_at DESC
");
$stmt->execute([$user['id']]);
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Получаем все возможные статусы задач
$stmt = $pdo->prepare("SELECT * FROM task_status");
$stmt->execute();
$statuses = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Отображаем шаблон
$html = file_get_contents('../templates/tasks_template.html');
echo eval('?>' . preg_replace('/\{\{(.*?)\}\}/', '<?php echo $1; ?>', $html) . '<?php');
?> 