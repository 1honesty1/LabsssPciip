<?php
// Задаём месяц и год
$month = 5; // Например, май
$year = date("Y");

// Определяем количество дней в заданном месяце
$num_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);

// Массив для перевода англоязычных названий дней в русский
$daysOfWeek = array(
    'Monday'    => 'Понедельник',
    'Tuesday'   => 'Вторник',
    'Wednesday' => 'Среда',
    'Thursday'  => 'Четверг',
    'Friday'    => 'Пятница',
    'Saturday'  => 'Суббота',
    'Sunday'    => 'Воскресенье'
);

echo "Вывод дней недели для месяца <strong>$month</strong> года <strong>$year</strong>:<br><br>";

for ($day = 1; $day <= $num_days; $day++) {
    // Получаем временную метку для заданного дня
    $timestamp = mktime(0, 0, 0, $month, $day, $year);
    // Получаем название дня недели на английском
    $dayEng = date("l", $timestamp);
    // Переводим в русский (при наличии в массиве)
    $dayRu = isset($daysOfWeek[$dayEng]) ? $daysOfWeek[$dayEng] : $dayEng;
    echo "День $day: $dayRu<br>";
}
?> 