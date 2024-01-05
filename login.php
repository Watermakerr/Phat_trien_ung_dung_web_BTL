<?php
require 'header.php';
if (isset($_SESSION['username'])) {
    header('Location: index.php');
}
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['role_id'] = $row['role_id'];
            if ($row['role_id'] == 1) {
                header('Location: admin/index.php');
            } else {
                header('Location: index.php');
            }
        } else {
            $error = "Sai mật khẩu";
        }
    } else {
        $error = "Sai tên đăng nhập";
    }
    mysqli_close($conn);
}
?>
<div class="container">
    <div class="row">
        <div class="col-6 mx-auto my-5">
            <form action="" method="POST">
                <?php
                if (isset($error)) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
                ?>
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
    require 'footer.php';
?>