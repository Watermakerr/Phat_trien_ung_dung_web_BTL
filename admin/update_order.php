<!DOCTYPE html>
<html lang="en">
<body>
    <?php
    require 'header.php';
    $id = $_GET['id'];
    $sql = "SELECT * FROM `orders` WHERE `order_id` = '$id'";
    $result = $conn->query($sql);
    if ($result->num_rows <= 0) {
        die("Record not found");
    } else {
        $row = $result->fetch_assoc();
    }
    ?>
    <div class="row">
        <div class="col-6 mx-auto my-5">
            <form action="" method="post" class="form-group">
                <h1 class="text-center">Update order</h1>
                <div class="form-group">
                    <label for="status">Tình trạng đơn hàng</label>
                    <select name="status" id="" class="form-control">
                        <option value="0">Đang chờ xác nhận</option>
                        <option value="1">Đã xác nhận</option>
                        <option value="2">Đang giao hàng</option>
                        <option value="3">Đã giao hàng</option>
                        <option value="4">Đã hủy</option>
                    </select>
                    
                </div>
                <input type="submit" name="submit" value="update" class="btn btn-success">
            </form>
        </div>
        <?php
        if (isset($_POST['submit'])) {
            $id = $_GET['id'];
            $status = $_POST['status'];
            $sql = "UPDATE `orders` SET `status`='$status' WHERE `order_id` = '$id'";
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Cập nhật thành công')</script>";
                echo "<script>window.location.href = 'show_order.php'</script>";
            } else {
                echo "<script>alert('Có lỗi xảy ra')</script>";
            }
            $conn->close();
        }
        ?>
</body>

</html>