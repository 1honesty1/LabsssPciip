<?php
// Вывод некоторых предопределенных констант
echo "Путь к текущему файлу: " . __FILE__ . "<br>";
echo "Текущая директория: " . __DIR__ . "<br>";
echo "Версия PHP: " . PHP_VERSION . "<br>";
echo "Текущая строка: " . __LINE__ . "<br>";

// Пример использования предопределенной переменной $_SERVER
echo "Хост: " . $_SERVER['HTTP_HOST'] . "<br>";
echo "Запрошенный URI: " . $_SERVER['REQUEST_URI'] . "<br>";
echo "IP-адрес клиента: " . $_SERVER['REMOTE_ADDR'] . "<br>";
?>
<p><a href="index.php">Вернуться на главную страницу</a></p> 