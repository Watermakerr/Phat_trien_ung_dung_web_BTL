<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- font awesom -->
</head>

<body>
    <?php
    session_start();
    if ($_SESSION['username'] != 'admin') {
        echo "<script>".
            "alert('Bạn không có quyền admin');".
            "window.location.href='../login.php';".
            "</script>";   
    }
    ?>
    <div class="row bg-info mr-0 py-1">
        <div class="col-sm-6">
            <h1 class="text-center float-left ml-3">Show feedback</h1>
        </div>
        <div class="col-sm-6 my-auto">
            <a href="logout.php" class="btn btn-success float-right">Logout</a>
            <a href="create.php" class="btn btn-success float-right mr-1">
                <i class="fas fa-plus"></i> Add New Feedback
            </a>
            </span>
        </div>
    </div>
    <?php
    require 'connect.php';
    $limit = 5;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $start = ($page - 1) * $limit;

    $sql = "SELECT * FROM `feedbacks` order by `createAt` DESC LIMIT $start, $limit";
    $result = $conn->query($sql);

    $total_result = $conn->query("SELECT COUNT(*) as total FROM `feedbacks`");
    $total_row = $total_result->fetch_assoc();
    $total_pages = ceil($total_row['total'] / $limit);

    if ($result-> num_rows > 0) {
        echo "<table class='table table-bordered table-striped text-center'>";
        echo "<thead class='thead-dark'>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Message</th>";
        echo "<th>User</th>";
        echo "<th>Product</th>";
        echo "<th>Time</th>";
        echo "<th>Action</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['feedback_id'] . "</td>";
            echo "<td>" . $row['message'] . "</td>";
            echo "<td>" . $row['user_id'] . "</td>";
            echo "<td>" . $row['product_id'] . "</td>";
            echo "<td>" . $row['createAt'] . "</td>";
            echo "<td>" . "<a href='update.php?id=" . $row['feedback_id'] . "'><i class='fas fa-edit'></i></a>" .
                "<a href='/web_project/admin/delete.php?id=" . $row['feedback_id'] . "' class='ml-1' onclick='return confirmDelete()'><i class='fas fa-trash-alt'></i></a>" .
                "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
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
            return confirm("Are you sure you want to delete this flight?");
        }
    </script>
</body>

</html>