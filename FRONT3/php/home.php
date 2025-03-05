<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

$user = $_SESSION['user'];

$html = file_get_contents('../templates/home_template.html');

$html = eval('?>' . preg_replace('/\{\{(.*?)\}\}/', '<?php echo $1; ?>', $html) . '<?php');

echo $html;
?>
