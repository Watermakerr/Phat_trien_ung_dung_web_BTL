<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
<?php
    require 'header.php';
    $id = $_GET['id'];
    $sql = "SELECT products.name as product_name, quantity FROM `order_details` INNER JOIN products on order_details.product_id = products.product_id WHERE `order_id` = '$id'";
    $result = $conn->query($sql);
    if ($result-> num_rows <= 0) {
        die("Record not found");
    } else {
        $row = $result->fetch_assoc();
    }
    ?>
    <div class="container " style="margin-top: 100px;">
    <h1 class="text-center float-left ml-3 ">Order detail</h1>
        <div class="table">
            <table  class='table table-bordered table-striped text-center'>
            <thead class='thead-dark'>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                </tr>
                    <tr>
                        <td><?php echo $row['product_name']?></td>
                        <td><?php echo $row['quantity']?></td>
                    </tr>
            </table>
            <div class="col-sm-6 my-auto">
                <a href="show_order.php" class="btn btn-info float-right mr-1">Quay lại</a>
             </div>

</body>

</html>