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
    require 'connect.php';
    $id = $_POST['id'];
    $message = $_POST['message'];
    $user_id = $_SESSION['user_id'];
    $sql = "INSERT INTO `feedbacks`(`message`, `user_id`, `product_id`) VALUES ('$message','$user_id','$id')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>window.location.href = 'product.php?id=$id'</script>";
    } else {
        echo "<script>alert('Error')</script>"
        . "<script>window.location.href = 'product.php?id=$id'</script>";
    }
    ?>
</body>
</html>