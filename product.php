<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- bootrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <?php
    session_start();
    $id = $_GET['id'];
    ?>
    <script>
        function checkLogin(event) {
            <?php if (!isset($_SESSION['username'])) : ?>
                event.preventDefault();
                alert('Bạn phải đăng nhập');
            <?php endif; ?>
        }
    </script>
    <div class="row m-0">
        <img src="" alt="Hình ảnh" class="img-thumbnail">
    </div>
    <div class="d-flex justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-0 border bg-primary">
                <div class="card-body p4">
                    <form action="/web_project/feedback.php" method="get" onsubmit="checkLogin(event)">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <div class="form-outline mb-4">
                            <input type="text" name="message" class="form-control" placeholder="Type comment..." />
                            <button class="btn bg-danger text-white mt-3">Add comment</button>
                        </div>
                    </form>
                    <?php
                    require_once 'connect.php';
                    $sql = "SELECT `message`, `username` " .
                        "FROM feedbacks " .
                        "INNER JOIN users ON feedbacks.user_id = users.user_id " .
                        "WHERE feedbacks.product_id = '$id'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<div class='card mb-3 shadow-0 border'>";
                            echo "<div class='card-body'>";
                            echo "<h5 class='card-title'>" . $row['username'] . "</h5>";
                            echo "<p class='card-text'>" . $row['message'] . "</p>";
                            echo "</div>";
                            echo "</div>";
                        }
                    } else {
                        echo "0 results";
                    }
                    mysqli_close($conn);
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>