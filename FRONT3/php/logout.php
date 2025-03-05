<?php
session_start();
session_unset();  // Удаляет все данные сессии
session_destroy();  // Уничтожает сессию
header('Location: ../php/index.php');  // Перенаправление на страницу входа
exit;
