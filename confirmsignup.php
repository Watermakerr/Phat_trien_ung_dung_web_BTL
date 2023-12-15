<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    session_start();
    if (isset($_SESSION['username'])) {
        header('Location: index.php');
    }
    require_once 'connect.php';
    if (isset($_POST['submit'])) {
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $sql = "INSERT INTO users (`fullname`, `username`, `email`, `password`) VALUES ('$fullname', '$username', '$email', '$password')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "<script>".
                "alert('Đăng ký thành công');".
                "window.location.href='index.php';".
                "</script>";
        } else {
            echo "<script>".
                "alert('Đăng ký thất bại. Tài khoản đã có người sử dụng');".
                "window.location.href='signup.php';".
                "</script>";
        }
        // close connection
        mysqli_close($conn);
    }
?>
</body>
</html>