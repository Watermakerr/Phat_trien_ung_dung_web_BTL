<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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