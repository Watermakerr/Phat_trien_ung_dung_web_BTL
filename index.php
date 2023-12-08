<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Đây là trang chủ</h1>
    <?php
        session_start();
        if ($_SESSION['username']) {
            echo "Xin chào ".$_SESSION['username'];
    ?>
    <a href="logout.php">Đăng xuất</a>
    <?php
        } else {
            echo "Bạn chưa đăng nhập";
            echo "<br>";
            echo "<a href='signup.php'>Đăng ký</a>";
            echo "<a href='login.php'>Đăng nhập</a>";
        }
    ?>
    <a href="product.php/?id=1">Đây là sản phẩm 1</a>
</body>
</html>