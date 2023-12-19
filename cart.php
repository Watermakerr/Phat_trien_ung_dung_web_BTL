<!DOCTYPE html>
<html lang="en">

<body>
    <?php
    include 'header.php';
    ?>

    <?php
    if ($_GET['action'] == 'add') {
        $id = $_POST['id'];
        $quantity = $_POST['quantity'];

        $sql = "SELECT * FROM products WHERE product_id = '$id'";
        $result = mysqli_query($conn, $sql);
        $stt = 1;
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                if (isset($_SESSION['cartItem'][$id])) {
                    $_SESSION['cartItem'][$id]['quantity'] += $quantity;
                } else {
                    $_SESSION['cartItem'][$id] = array(
                        'stt' => $stt++, 
                        'name' => $row['name'],
                        'price' => $row['price'],
                        'quantity' => $quantity,
                        'image' => 'asset/image/a31.jpg'
                    );
                }
                $_SESSION['cartItem'][$id]['total'] = $row['price'] * $_SESSION['cartItem'][$id]['quantity'];
    ?>

    <?php
            }
        }
    }
    header('Location: viewcart.php')
    ?>
</body>