<?php
require 'header.php';
$id = $_GET['id'];
$sql = "SELECT * FROM `categories` WHERE `category_id` = '$id'";
$result = $conn->query($sql);
if ($result->num_rows <= 0) {
    die("Record not found");
} else {
    $row = $result->fetch_assoc();
}
if (isset($_POST['submit'])) {
    $name = $_POST['message'];
    $status = $_POST['status'];
    $sql = "UPDATE `categories` SET `name`='$name', `status`='$status' WHERE `category_id` = '$id'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Cập nhật thành công')</script>";
        echo "<script>window.location.href = 'show_category.php'</script>";
    } else {
        echo "<script>alert('Có lỗi xảy ra')</script>";
    }
    $conn->close();
}
?>
<div class="row">
    <div class="col-6 mx-auto my-5">
        <form action="" method="post" class="form-group">
            <h1 class="text-center">Update category</h1>
            <div class="form-group">
                <label for="">Tên danh mục</label>
                <input type="text " name="message" class="form-control" value="<?php echo $row['name']; ?> ">
            </div>
            <div class="form-group">
                <label for="">Status</label>
                <div>
                    <input type="radio" name="status" value="Active" <?php if ($row['status'] == 'Active') echo 'checked'; ?>>
                    <label for="">Active</label>
                </div>
                <div>
                    <input type="radio" name="status" value="Inactive" <?php if ($row['status'] == 'Inactive') echo 'checked'; ?>>
                    <label for="">Inactive</label>
                </div>
            </div>
            <input type="submit" name="submit" value="update" class="btn btn-success">
        </form>
    </div>
</div>