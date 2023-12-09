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
    if (!$_SESSION['username']) {
        header('Location: login.php');
    }
    require 'connect.php';
    $id = $_GET['id'];
    $sql = "DELETE FROM `feedbacks` WHERE feedback_id = $id";
    if ($conn->query($sql) === TRUE) {
        header("Location: show_feedback.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    ?>
</body>
</html>