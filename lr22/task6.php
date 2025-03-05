<?php
/**
 * Функция calculateFormula реализует вычисление по формуле:
 *      F = (a + sqrt(b)) / (c - d)
 * с проверкой ошибок: деление на ноль и извлечение корня из отрицательного числа.
 *
 * @param float $a
 * @param float $b
 * @param float $c
 * @param float $d
 * @return float
 * @throws Exception в случае ошибки вычислений.
 */
function calculateFormula($a, $b, $c, $d) {
    // Проверка на деление на ноль
    if (($c - $d) == 0) {
        throw new Exception("Ошибка: деление на ноль, так как c - d = 0.");
    }
    // Проверка на извлечение квадратного корня из отрицательного числа
    if ($b < 0) {
        throw new Exception("Ошибка: невозможно извлечь квадратный корень из отрицательного числа b = $b.");
    }
    
    $sqrt_b = sqrt($b);
    $result = ($a + $sqrt_b) / ($c - $d);
    return $result;
}

// Пример использования функции:
$a = 10;
$b = 16; // положительное число, sqrt(16)=4
$c = 8;
$d = 3;  // c - d = 5, не равен 0

try {
    $formulaResult = calculateFormula($a, $b, $c, $d);
    echo "Результат вычисления формулы ((a + sqrt(b)) / (c - d)) при a = $a, b = $b, c = $c, d = $d равен: $formulaResult<br>";
} catch (Exception $e) {
    echo $e->getMessage() . "<br>";
}
?> 