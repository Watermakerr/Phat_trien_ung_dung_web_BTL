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
        if ($_GET['action'] == 'delete') {
            if (isset($_POST['checkbox'])) {
                $ids = $_POST['checkbox'];
                if (!empty($ids)) {
                    $ids = implode(',', array_map('intval', $ids)); // Sanitize the ids
                    $sql = "DELETE FROM `categories` WHERE category_id IN ($ids)";
                    if ($conn->query($sql) !== TRUE) {
                        echo "<script>alert('Không thể xóa sản phầm này')</script>";
                    } else {
                        echo "<script>alert('Xóa thành công')</script>";
                    }
                }
            }
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "DELETE FROM `categories` WHERE category_id = $id";
                if ($conn->query($sql) !== TRUE) {
                    echo "<script>alert('Không thể xóa sản phầm này')</script>";
                } else {
                    echo "<script>alert('Xóa thành công')</script>";
                }
            }
        }
        ?>
    <div class="row bg-dark mr-0 py-1">
        <div class="col-sm-6">
            <h1 class="text-center text-white float-left ml-3">Show category</h1>
        </div>
        <div class="col-sm-6 my-auto">
            <a href="create_category.php" class="btn btn-info float-right mr-1">Thêm danh mục</a>
            <a href="index.php" class="btn btn-info float-right mr-1">Quay lại</a>
            <a href="../logout.php" class="btn btn-info float-right">Đăng xuất</a>
        </div>
    </div>
    <?php
    $limit = 5;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $start = ($page - 1) * $limit;
    $sql = "SELECT * FROM `categories` LIMIT $start, $limit";
    $result = $conn->query($sql);
    $total_result = $conn->query("SELECT COUNT(*) as total FROM `categories`");
    $total_row = $total_result->fetch_assoc();
    $total_pages = ceil($total_row['total'] / $limit);
    if ($result->num_rows > 0) { ?>
    <form action="?action=delete" method="post">
        <table class='table table-bordered table-striped text-center'>
            <thead class='thead-dark'>
                <tr>
                    <th></th>
                    <th>Tên danh mục</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><input type="checkbox" name="checkbox[]" value="<?php echo $row['category_id']; ?>"></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td>
                        <a href="update_category.php?id=<?php echo $row['category_id']; ?>"><i class='fas fa-edit'></i></a>
                        <a href="?action=delete&id=<?php echo $row['category_id']; ?>"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
    </form>
    <?php } ?>

</body>
</html>