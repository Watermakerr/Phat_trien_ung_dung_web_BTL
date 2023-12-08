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
    <div class="row m-0">
        <img src="" alt="Hình ảnh" class="img-thumbnail">
    </div>
    <div class="d-flex justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-0 border bg-primary">
                <div class="card-body p4">
                    <div class="form-outline mb-4">
                        <input type="text" name="message" class="form-control" placeholder="Type comment..." />
                        <a href="#" class="btn">Add comment</a>
                    </div>
                    <?php
                    require_once 'connect.php';
                    $id = $_GET['id'];
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