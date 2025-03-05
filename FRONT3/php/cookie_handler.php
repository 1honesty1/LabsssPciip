<?php
$userName = isset($_COOKIE['user_name']) ? $_COOKIE['user_name'] : '';
$userSurname = isset($_COOKIE['user_surname']) ? $_COOKIE['user_surname'] : '';
$productName = isset($_COOKIE['product_name']) ? $_COOKIE['product_name'] : '';
$productDescription = isset($_COOKIE['product_description']) ? $_COOKIE['product_description'] : '';

// Очистка куки
if (isset($_GET['clear'])) {
    setcookie('user_name', '', time() - 3600, "/");
    setcookie('user_surname', '', time() - 3600, "/");
    setcookie('product_name', '', time() - 3600, "/");
    setcookie('product_description', '', time() - 3600, "/");
    header('Location: index.php');
    exit;
}

echo "Продукт: " . htmlspecialchars($productName) . "<br>";
echo "Описание: " . htmlspecialchars($productDescription) . "<br>";
?>

<form method="GET" action="">
    <button type="submit" name="clear" style="margin-top: 20px;">Очистить куки</button>
</form>

<script>
    localStorage.setItem('user_name', '<?php echo htmlspecialchars($userName); ?>');
    localStorage.setItem('user_surname', '<?php echo htmlspecialchars($userSurname); ?>');
</script> 