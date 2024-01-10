<?php
require 'header.php';
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Bạn phải đăng nhập')</script>" .
        "<script>window.location.href = 'login.php'</script>";
}
?>
<div class="container">
    <h1 class="text-center">Đơn hàng của bạn</h1>
    <div class="table">
        <table class="table text-center my-auto">
            <tr class="bg-secondary text-light w-100" style="height: 30px;">
                <th>STT</th>
                <th>Mã đơn hàng</th>
                <th>Ngày đặt hàng</th>
                <th>Trạng thái</th>
                <th></th>
            </tr>
            <?php
            $stt = 1;
            $sql = "SELECT * FROM orders WHERE user_id = {$_SESSION['user_id']}";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <td><?php echo $stt++; ?></td>
                    <td><?php echo $row['order_id']; ?></td>
                    <td><?php echo $row['create_at']; ?></td>
                    <td>
                        <?php
                        switch ($row['status']) {
                            case 0:
                                echo "Đang chờ xác nhận";
                                break;
                            case 1:
                                echo "Đã xác nhận";
                                break;
                            case 2:
                                echo "Đang giao hàng";
                                break;
                            case 3:
                                echo "Đã giao hàng";
                                break;
                            case 4:
                                echo "Đã hủy";
                                break;
                            default:
                                echo "Trạng thái không xác định";
                                break;
                        }
                        ?>
                    </td>
                    <td>
                        <a href="order_detail.php?id=<?php echo $row['order_id']; ?>" class="btn btn-info">Xem chi tiết</a>
                    </td>
                <?php
            }
                ?>
        </table>
    </div>
</div>
<?php
require 'footer.php';
?>