<!DOCTYPE html>
<html lang="en">

<body>
    <?php
    require 'header.php';
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

    $sql = "SELECT * FROM `users` order by `create_at` DESC LIMIT $start, $limit";
    $result = $conn->query($sql);

    $total_result = $conn->query("SELECT COUNT(*) as total FROM `users`");
    $total_row = $total_result->fetch_assoc();
    $total_pages = ceil($total_row['total'] / $limit);

    if ($result->num_rows > 0) { ?>
        <table class='table table-bordered table-striped text-center'>
            <thead class='thead-dark'>
                <tr>
                    <th></th>
                    <th>Tên đăng nhập</th>
                    <th>Họ và tên </th>
                    <th>Email</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $counter = ($page - 1) * $limit + 1;
                while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                    <td><input type="checkbox" name="checkbox" value = "<?php $row['user_id']?>"></td>
                        <td><?php echo $row['username'] ?></td>   
                        <td><?php echo $row['fullname'] ?></td>
                        <td><?php echo $row['email'] ?></td>
                        <td><a href='delete_user.php?id= <?php echo $row['user_id'] ?>' class='ml-1' onclick='return confirmDelete()'><i class='fas fa-trash-alt'></i></a>
                        </td>
                    </tr>
                <?php
                    $counter++;
                }
                ?>
            </tbody>
        </table>
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