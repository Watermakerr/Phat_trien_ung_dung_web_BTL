<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="asset/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-6 mx-auto my-5">
                <form action="" method="POST">
                    <h2 class="text-center">Trang đăng nhập</h2>
                    <div class="form-group">
                        <label for="username">Tên đăng nhập</label>
                        <input type="username" name="username" id="username" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="password">Mật khẩu</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <input name="submit" type="submit" class="btn btn-primary form-control" id="submit" value="Đăng nhập"></input>
                </form>
                <p class="text-center">Bạn chưa có tài khoản? <a href="signup.php">Đăng ký</a></p>
            </div>
        </div>
    </div>
    </div>
    <?php
    session_start();
    if (isset($_SESSION['username'])) {
        header('Location: index.php');
    }
    require_once 'connect.php';
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['username'] = $row['username'];
            $_SESSION['user_id'] = $row['user_id'];
            echo "<script>" .
                "alert('Đăng nhập thành công');" .
                "window.location.href='index.php';" .
                "</script>";
        } else {
            echo "<script>" .
                "alert('Sai mật khẩu hoặc tên đăng nhập');"
                . "</script>";
        }
        // close connection
        mysqli_close($conn);
    }
    ?>
</body>

</html>