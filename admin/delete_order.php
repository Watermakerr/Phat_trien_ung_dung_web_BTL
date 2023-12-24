<!DOCTYPE html>
<html lang="en">
</head>
<body>
    <?php
    require 'header.php';
    $id = $_GET['id'];
    $sql = "DELETE FROM `orders` WHERE order_id = $id";
    if ($conn->query($sql) === TRUE) {
        header("Location: show_order.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    ?>
</body>
</html>