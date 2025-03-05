<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'dispatcher') {
    header('Location: index.php');
    exit;
}

$user = $_SESSION['user'];
$statusFilter = '';
$executorFilter = '';
$sortOrder = 'ASC'; // По умолчанию сортировка по возрастанию

if (isset($_POST['status_filter'])) {
    $statusFilter = $_POST['status_filter'];
}

if (isset($_POST['executor_filter'])) {
    $executorFilter = $_POST['executor_filter'];
}

if (isset($_POST['sort_order'])) {
    $sortOrder = $_POST['sort_order'] === 'ASC' ? 'ASC' : 'DESC'; // Проверка на корректность
}

$stmt = $pdo->prepare("
    SELECT t.*, ts.name as status_name, u.name as executor_name, u.surname as executor_surname 
    FROM tasks t 
    JOIN task_status ts ON t.status_id = ts.id 
    LEFT JOIN users u ON t.executor_id = u.id 
    WHERE t.dispatcher_id = ? 
    AND (u.surname LIKE ?)
    AND (ts.id = ? OR ? = '')
    ORDER BY t.title $sortOrder
");
$stmt->execute([$user['id'], "%$executorFilter%", $statusFilter, $statusFilter]);

$statuses = $pdo->query("SELECT * FROM task_status")->fetchAll(PDO::FETCH_ASSOC);
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

$html = file_get_contents('../templates/admin_template.html');
$html = str_replace('{{tasks}}', json_encode($tasks), $html);
$html = str_replace('{{statuses}}', json_encode($statuses), $html);
$html = str_replace('{{executorFilter}}', htmlspecialchars($executorFilter), $html);
$html = str_replace('{{statusFilter}}', htmlspecialchars($statusFilter), $html);
$html = str_replace('{{sortOrder}}', $sortOrder, $html);
echo eval('?>' . preg_replace('/\{\{(.*?)\}\}/', '<?php echo $1; ?>', $html) . '<?php');
?> 