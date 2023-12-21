<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    require_once 'header.php';
    if ($_GET['action'] == 'delete') {
        $id = $_GET['id'];
        unset($_SESSION['cartItem'][$id]);
    }

    ?>
    <div class="container " style="margin-top: 100px;">
        <p class="text-center">Giỏ hàng</p>
        <div class="table">
            <table class="table text-center my-auto">
                <tr class="bg-secondary text-light w-100" style="height: 30px;">
                    <th>STT</th>
                    <th>Hình ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                    <th>Hành động</th>
                </tr>
                <?php
                $total = 0;
                $stt = 1;
                foreach ($_SESSION['cartItem'] as $item) {
                    $total += $item['total'];
                ?>
                    <tr>
                        <td><?php echo $stt++; ?></td>
                        <td><img src="<?php echo $item['image']; ?>" alt="" style="width: 100px;"></td>
                        <td><?php echo $item['name']; ?></td>
                        <td><?php echo number_format($item['price']); ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td><?php echo isset($item['total']) ? number_format($item['total']) : 0; ?></td>
                        <td>
                            <a href='?action=delete&id=<?php echo $item['id'] ?>' class='ml-1' onclick='return confirmDelete()'><i class='fas fa-trash-alt'></i></a>
                        </td>
                    </tr>
                <?php
                }
                ?>
                <tr>
                    <td colspan="5">Tổng tiền</td>
                    <td><?php echo number_format($total) ?>đ</td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>