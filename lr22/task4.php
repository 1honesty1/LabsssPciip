<?php
// Формируем исходный массив из 5 целых чисел
$originalArray = array(3, -7, 10, -2, 5);

echo "Исходный массив:<br>";
echo implode(", ", $originalArray) . "<br><br>";

// Вычисляем сумму положительных элементов
$sumPositive = 0;
foreach ($originalArray as $value) {
    if ($value > 0) {
        $sumPositive += $value;
    }
}
echo "Сумма положительных элементов: $sumPositive<br><br>";

// Сортировка массива по возрастанию
$sortedArray = $originalArray; // копируем исходный массив
sort($sortedArray);

echo "Отсортированный массив по возрастанию:<br>";
echo implode(", ", $sortedArray) . "<br>";
?> 