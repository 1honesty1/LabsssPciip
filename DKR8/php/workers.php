<?php
session_start();
require 'config.php';

// Проверка авторизации и роли
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'dispatcher') {
    header('Location: index.php');
    exit;
}

$user = $_SESSION['user'];

// Получаем все задачи, созданные текущим диспетчером
$stmt = $pdo->prepare("
    SELECT t.*, 
           ts.name as status_name,
           e.name as executor_name,
           e.surname as executor_surname
    FROM tasks t
    JOIN task_status ts ON t.status_id = ts.id
    JOIN users e ON t.executor_id = e.id
    WHERE t.dispatcher_id = ?
    ORDER BY t.created_at DESC
");
$stmt->execute([$user['id']]);
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Отображаем шаблон
$html = file_get_contents('../templates/workers_template.html');
echo eval('?>' . preg_replace('/\{\{(.*?)\}\}/', '<?php echo $1; ?>', $html) . '<?php');
?> 