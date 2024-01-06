<?php
require 'header.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM orders WHERE order_id = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row['user_id'] != $_SESSION['user_id']) {
        echo "<script>window.location.href = 'index.php'</script>";
    }
    $sql = "SELECT * FROM order_details WHERE order_id = $id";
    $result = mysqli_query($conn, $sql);
    $stt = 1;
?>
    <div class="container">
        <h1 class="text-center">Chi tiết đơn hàng</h1>
        <div class="table">
            <table class="table text-center my-auto">
                <tr class="bg-secondary text-light w-100" style="height: 30px;">
                    <th>STT</th>
                    <th>Hình ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
                <?php
                $total = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $sql = "SELECT * FROM products WHERE product_id = {$row['product_id']}";
                    $result2 = mysqli_query($conn, $sql);
                    $row2 = mysqli_fetch_assoc($result2);
                    $total += $row2['price'] * $row['quantity'];
                ?>
                    <tr>
                        <td><?php echo $stt++; ?></td>
                        <td><img src="../asset/image/<?php echo $row2['image'] ?>" alt="" style="width: 100px;"></td>
                        <td><?php echo $row2['name']; ?></td>
                        <td><?php echo number_format($row2['price']); ?></td>
                        <td><?php echo $row['quantity']; ?></td>
                        <td><?php echo number_format($row2['price'] * $row['quantity']) ?></td>
                    </tr>

                <?php
                }
                ?>
                <tr>
                    <td colspan="5">Tổng tiền</td>
                    <td><?php echo number_format($total) ?>đ</td>
            </table>
            <!-- button return -->
            <div class="text-center mt-3">
                <a href="index.php" class="btn btn-info">Quay lại</a>
        </div>
    </div>
<?php
}
?>
<?php
require 'footer.php';
?>