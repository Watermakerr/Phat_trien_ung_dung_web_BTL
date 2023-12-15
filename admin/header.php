<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="asset/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
</head>

<body>
    <?php
    session_start();
    if ($_SESSION['role_id'] != 1) {
        echo "<script>" .
            "alert('Bạn không có quyền admin');" .
            "window.location.href='../login.php';" .
            "</script>";
    }
    require '../connect.php';
    ?>
</body>

</html>