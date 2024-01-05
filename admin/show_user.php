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
                $sql = "DELETE FROM `users` WHERE user_id IN ($ids)";
                if ($conn->query($sql) !== TRUE) {
                    echo "<script>alert('Không thể xóa người dùng này')</script>";
                } else {
                    echo "<script>alert('Xóa thành công')</script>";
                }
            }
        }
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "DELETE FROM `users` WHERE user_id = $id";
            if ($conn->query($sql) !== TRUE) {
                echo "<script>alert('Không thể xóa người dùng này')</script>";
            } else {
                echo "<script>alert('Xóa thành công')</script>";
            }
        }
    }
    ?>
    <div class="row bg-dark mr-0 py-1">
        <div class="col-sm-6">
            <h1 class="text-center text-white float-left ml-3 ">Show product</h1>
        </div>
        <div class="col-sm-6 my-auto">
            <a href="index.php" class="btn btn-info float-right mr-1">Trang chủ</a>
            <a href="../logout.php" class="btn btn-info float-right">Đăng xuất</a>
        </div>
    </div>
    <?php
    $limit = 5;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $start = ($page - 1) * $limit;

    $sql = "SELECT user_id, username, fullname, email, role_name FROM `users`
            INNER JOIN roles ON roles.role_id = users.role_id
            order by users.create_at DESC LIMIT $start, $limit";
    $result = $conn->query($sql);

    $total_result = $conn->query("SELECT COUNT(*) as total FROM `users`");
    $total_row = $total_result->fetch_assoc();
    $total_pages = ceil($total_row['total'] / $limit);

    if ($result->num_rows > 0) { ?>
        <form action="show_user.php?action=delete" method="post">
            <table class='table table-bordered table-striped text-center'>
                <thead class='thead-dark'>
                    <tr>
                        <th></th>
                        <th>Tên đăng nhập</th>
                        <th>Họ và tên </th>
                        <th>Email</th>
                        <th>Vai trò</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $counter = ($page - 1) * $limit + 1;
                    while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><input type="checkbox" name="checkbox[]" value="<?php echo $row['user_id'] ?>"></td>
                            <td><?php echo $row['username'] ?></td>
                            <td><?php echo $row['fullname'] ?></td>
                            <td><?php echo $row['email'] ?></td>
                            <td><?php echo $row['role_name'] ?></td>
                            <td><a href='update_user.php?id=<?php echo $row['user_id'] ?> '><i class='fas fa-edit'></i></a>
                                <a href='?action=delete&id=<?php echo $row['user_id'] ?>' class='ml-1' onclick='return confirmDelete()'><i class='fas fa-trash-alt'></i></a>
                            </td>
                        </tr>
                    <?php
                        $counter++;
                    }
                    ?>
                </tbody>
            </table>
            <input type="submit" name="submit" value="delete" class="btn btn-danger">
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
            return confirm("Are you sure you want to delete this user?");
        }
    </script>
</body>

</html>