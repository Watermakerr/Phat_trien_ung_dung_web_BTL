<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <?php
    require 'connect.php';
    if (isset($_POST['submit'])) {
        $message = $_POST['message'];
        $user = $_POST['user'];
        $product = $_POST['product'];
        $sql = "INSERT INTO `feedbacks`(`message`, `user_id`, `product_id`) VALUES ('$message','$user','$product')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Data added succesfully')</script>";
            echo "<script>window.location.href = 'show_feedback.php'</script>";
        } else {
            echo "<script>alert('Error')</script>";
        }
        $conn->close();
    }
    ?>
    <div class="row">
        <div class="col-6 mx-auto my-5">
            <form action="" method="post" class="form-group">
                <h1 class="text-center">Create feedback</h1>
                <div class="form-group">
                    <label for="">Message:</label>
                    <input type="text " name="message" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">User:</label>
                    <input type="text" name="user" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Product:</label>
                    <input type="text" name="product" class="form-control">
                </div>
                <input type="submit" name="submit" value="Add" class="btn btn-success">
            </form>
        </div>
</body>

</html>