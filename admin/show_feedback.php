<!DOCTYPE html>
<html lang="en">

<body>
    <?php
    require 'header.php';
    ?>
    <div class="row bg-dark mr-0 py-1">
        <div class="col-sm-6">
            <h1 class="text-center text-white float-left ml-3">Show feedback</h1>
        </div>
        <div class="col-sm-6 my-auto">
            <a href="../logout.php" class="btn btn-info float-right">Đăng xuất</a>
            <a href="create_feedback.php" class="btn btn-info float-right mr-1">
                <i class="fas fa-plus"></i> Thêm bình luận mới
            </a>
            <a href="index.php" class="btn btn-info float-right mr-1">Trang chủ</a>
        </div>
    </div>
    <?php
    $sql_1 = "SELECT username FROM `users` INNER JOIN feedbacks WHERE users.user_id = feedbacks.user_id ";
    $result_1 = $conn->query($sql_1);

    $sql_2 = "SELECT products.name FROM `products` INNER JOIN feedbacks WHERE products.product_id = feedbacks.product_id ";
    $result_2 = $conn->query($sql_2);

    $limit = 5;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $start = ($page - 1) * $limit;

    $sql = "SELECT * FROM `feedbacks` order by `create_at` DESC LIMIT $start, $limit";
    $result = $conn->query($sql);

    $total_result = $conn->query("SELECT COUNT(*) as total FROM `feedbacks`");
    $total_row = $total_result->fetch_assoc();
    $total_pages = ceil($total_row['total'] / $limit);

    if ($result->num_rows > 0) { ?>
        <table class='table table-bordered table-striped text-center'>
            <thead class='thead-dark'>
                <tr>
                    <th></th>
                    <th>Message</th>
                    <th>User</th>
                    <th>Product</th>
                    <th>Time</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $counter = ($page - 1) * $limit + 1;
                while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><input type="checkbox" name="checkbox" value = "<?php $row['feedback_id']?>"></td>
                        <td><?php echo $row['message'] ?></td>
                        <td>
                        <?php
                            if (mysqli_num_rows($result_1) > 0) {
                                $row_1 = mysqli_fetch_assoc($result_1);
                                echo $row_1['username']; 
                            } ?>
                        </td>
                        <td>
                        <?php
                            if (mysqli_num_rows($result_2) > 0) {
                                $row_2 = mysqli_fetch_assoc($result_2);
                                echo $row_2['name']; 
                            } ?>
                        </td>
                        <td><?php echo $row['create_at'] ?></td>
                        <td><a href='update_feedback.php?id= <?php echo $row['feedback_id'] ?> '><i class='fas fa-edit'></i></a>
                            <a href='delete_feedback.php?id= <?php echo $row['feedback_id'] ?>' class='ml-1' onclick='return confirmDelete()'><i class='fas fa-trash-alt'></i></a>
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
            return confirm("Are you sure you want to delete this feedback?");
        }
    </script>
</body>

</html>