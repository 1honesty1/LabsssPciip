<?php
// Задаем параметры стиля
$color = "green"; // можно задать любой цвет
$size = 32;       // размер шрифта в пикселях

// ФИО разработчика (замените на реальные данные при необходимости)
$developerFIO = "Шапский Алексей Сергеевич";
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>ФИО разработчика</title>
</head>
<body>
    <p style="color: <?= $color ?>; font-size: <?= $size ?>px;">
        <?= $developerFIO ?>
    </p>
    <p><a href="index.php">Вернуться на главную страницу</a></p>
</body>
</html> 