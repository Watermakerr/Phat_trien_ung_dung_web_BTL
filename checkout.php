<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php require 'header.php'; 
    if (!isset($_SESSION['username'])) {
        header('Location: login.php');
    }
    if(!isset($_SESSION['cartItem'])){?>
    <script>
        alert('Giỏ hàng trống');
        window.location.href = 'index.php';                                                         
    </script>
    <?php
    }
    $sql = "INSERT INTO `orders`(`user_id`) VALUES ('" . $_SESSION['user_id'] . "')";
    $conn->query($sql);
    foreach ($_SESSION['cartItem'] as $item) {
        $sql = "INSERT INTO `order_details`(`order_id`, `product_id`, `quantity`) VALUES ((SELECT MAX(`order_id`) FROM `orders`), '" . $item['id'] . "', '" . $item['quantity'] . "')";
        $conn->query($sql);
    }
    unset($_SESSION['cartItem']);
    echo "<script>alert('Đặt hàng thành công'); window.location.href = 'index.php';</script>";
    ?>
</body>
</html>