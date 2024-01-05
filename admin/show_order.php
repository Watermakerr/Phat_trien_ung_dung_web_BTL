<!DOCTYPE html>
<html lang="en">

<body>
    <?php
    require 'header.php';
    if ($_GET['action'] == 'delete') {
        if (isset($_POST['checkbox'])) {
            $ids = $_POST['checkbox'];
            if (!empty($ids)) {
                $ids = implode(',', array_map('intval', $ids)); // Sanitize the ids
                $sql = "DELETE FROM `orders` WHERE order_id IN ($ids)";
                if ($conn->query($sql) !== TRUE) {
                    echo "<script>alert('Không thể xóa đơn hàng này')</script>";
                } else {
                    echo "<script>alert('Xóa thành công')</script>";
                }
            }
        }
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "DELETE FROM `orders` WHERE order_id = $id";
            if ($conn->query($sql) !== TRUE) {
                echo "<script>alert('Không thể xóa đơn hàng này')</script>";
            } else {
                echo "<script>alert('Xóa thành công')</script>";
            }
        }
    }
    ?>
    <div class="row bg-dark mr-0 py-1">
        <div class="col-sm-6">
            <h1 class="text-center text-white float-left ml-3">Show order</h1>
        </div>
        <div class="col-sm-6 my-auto">
            <a href="index.php" class="btn btn-info float-right mr-1">Quay lại</a>
            <a href="../logout.php" class="btn btn-info float-right">Đăng xuất</a>
        </div>
    </div>
    <?php
    $limit = 5;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $start = ($page - 1) * $limit;

    $sql = "SELECT username, order_id, status FROM `orders`
            INNER JOIN users 
            ON users.user_id = orders.user_id LIMIT $start, $limit";
    $result = $conn->query($sql);

    $total_result = $conn->query("SELECT COUNT(*) as total FROM `orders`");
    $total_row = $total_result->fetch_assoc();
    $total_pages = ceil($total_row['total'] / $limit);

    if ($result->num_rows > 0) { ?>
    <form action="?action=delete" method="post">
        <table class='table table-bordered table-striped text-center'>
            <thead class='thead-dark'>
                <tr>
                    <th></th>
                    <th>Mã đơn</th>
                    <th>Tài khoản đặt hàng</th>
                    <th>Trạng thái đơn hàng</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $counter = ($page - 1) * $limit + 1;
                while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><input type="checkbox" name="checkbox[]" value="<?php echo $row['order_id'] ?>"></td>
                        <td><?php echo $row['order_id'] ?></td>
                        <td><?php echo $row['username'] ?></td>
                        <td>
                            <?php
                            if ($row['status'] == 0) {
                                echo "Đang chờ xác nhận";
                            } elseif ($row['status'] == 1) {
                                echo "Đã xác nhận";
                            } elseif ($row['status'] == 2) {
                                echo "Đang giao hàng";
                            } elseif ($row['status'] == 3) {
                                echo "Đã giao hàng";
                            } elseif ($row['status'] == 4) {
                                echo "Đã hủy";
                            }
                            ?>
                        </td>
                        <td>
                            <a href='order_detail.php?id=<?php echo $row['order_id']?>'><i class="fas fa-eye"></i></a>
                            <a href='update_order.php?id=<?php echo $row['order_id']?> '><i class='fas fa-edit'></i></a>
                            <a href='?action=delete&id=<?php echo $row['order_id']?>' class='ml-1' onclick='return confirmDelete()'><i class='fas fa-trash-alt'></i></a>
                        </td>
                    </tr>
                <?php
                    $counter++;
                }
                ?>
            </tbody>
        </table>
        <button type="submit" class="btn btn-danger mb-3" onclick="return confirmDelete()">Xóa</button>
    </form>
    <?php
    } else {
        echo "0 results";
    }
    echo "<ul class='pagination justify-content-center'>";
    for ($i = 1; $i <= $total_pages; $i++) {
        echo "<li class='page-item'><a class='page-link' href='?page=" . $i . "'>" . $i . "</a></li>";
    }
    ?>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this order?");
        }
    </script>
</body>

</html>