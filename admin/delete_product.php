<!DOCTYPE html>
<html lang="en">
</head>
<body>
    <?php
    require 'header.php';
    if (isset($_POST['checkbox'])) {
        $ids = $_POST['checkbox'];
        if (!empty($ids)) {
            $ids = implode(',', array_map('intval', $ids)); // Sanitize the ids
            $sql = "DELETE FROM `products` WHERE product_id IN ($ids)";
            if ($conn->query($sql) !== TRUE) {
                die("Error deleting record: " . $conn->error);
            }
            else{
                header("Location: show_product.php");
            }
        }
    }
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']); // Sanitize the id
        $sql = "DELETE FROM `products` WHERE product_id = $id";
        if ($conn->query($sql) !== TRUE) {
            echo "Error deleting record: " . $conn->error;
        }
    }
    
    ?>
</body>
</html>