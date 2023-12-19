<!DOCTYPE html>
<html lang="en">

<body>
    <?php
    include 'header.php';
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        header('Location: index.php');
    }
    ?>
    <div>
        <div class="container" style="margin-top: 100px;">
            <div class="row">
                <div class="col-lg-6">
                    <img src="asset/image/a31.jpg" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6">
                    <form action="cart.php?action=add" method="post">
                        <h1 class="font-weight-bold">Sản phẩm 1</h1>
                        <p class="font-weight-bold">Giá: 100.000đ</p>
                        <p class="font-weight-bold">Mô tả: Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.</p>
                        <input type="number" class="form-custom-control-inline" name="quantity">
                        <input type="hidden" name="id" value="2">

                        <div class="text-center">
                            <button type="submit" class="btn btn-success"><i class="fas fa-shopping-cart"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-0 border bg-primary">
                <div class="card-body p4">
                    <form action="feedback.php" method="get" onsubmit="checkLogin(event)">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <div class="form-outline mb-4">
                            <input type="text" name="message" class="form-control" placeholder="Type comment..." />
                            <button id="submit" class="btn bg-danger text-white mt-3">Add comment</button>
                        </div>
                    </form>
                    <?php
                    require_once 'connect.php';
                    $sql = "SELECT `message`, `username`, `feedbacks`.`create_at` " .
                        "FROM feedbacks " .
                        "INNER JOIN users ON feedbacks.user_id = users.user_id " .
                        "WHERE feedbacks.product_id = '$id'" .
                        "ORDER BY feedbacks.create_at DESC";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) { ?>
                            <div class='card mb-3 shadow-0 border'>
                                <div class='card-body'>
                                    <h5 class='card-title'> <?php echo $row['username'] ?> </h5>
                                    <h6 class='card-subtitle mb-2 text-muted'> <?php echo $row['create_at'] ?> </h6>
                                    <p class='card-text'> <?php echo $row['message'] ?> </p>
                                </div>
                            </div>
                    <?php
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
    <script>
        function checkLogin(event) {
            <?php if (!isset($_SESSION['username'])) : ?>
                event.preventDefault();
                alert('Bạn phải đăng nhập');
            <?php endif; ?>
        }
        document.getElementById('submit').addEventListener('click', function(event) {
            var message = document.querySelector('input[name="message"]').value;
            if (message.length < 20) {
                alert('Bình luận phải có ít nhất 20 kí tự');
                event.preventDefault(); // Prevent the form from submitting
            }
        });
    </script>
</body>

</html>