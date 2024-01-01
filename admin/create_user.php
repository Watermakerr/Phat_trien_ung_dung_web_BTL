<?php
require_once 'header.php';
$error = [];
if (isset($_POST['submit'])) {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $role_id = $_POST['role_id'];
    if ($username == "" || $fullname == "" || $email == "" || $password == "") {
        $error[] = "Thông tin đang bỏ trống";
    }
    if (count($error) == 0) {
        $sql = "INSERT INTO users (`fullname`, `username`, `email`, `password`) VALUES ('$fullname', '$username', '$email', '$password')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Data added succesfully')</script>";
            echo "<script>window.location.href = 'show_user.php'</script>";
        }
    }
}
?>
<div class="row">
    <div class="col-6 mx-auto my-5">
        <?php if (count($error) > 0) : ?>
            <?php for ($i = 0; $i < count($error); $i++) : ?>
                <div class="alert alert-danger" role="alert">
                    <strong>Error: </strong><?php echo $error[$i]; ?></p>
                </div>
            <?php endfor; ?>
        <?php endif; ?>
        <form action="" method="post" class="form-group" enctype="multipart/form-data">
            <h1 class="text-center">Thêm người dùng</h1>
            <div class="form-group">
                <label for="username">Tên đăng nhập</label>
                <input type="text " name="username" class="form-control">
            </div>
            <div class="form-group mt-3">
                <label for="fullnamw">Họ và tên</label>
                <input type="text" name="fullname" class="form-control" min="0">
            </div>
            <div class="form-group mt-3">
                <label for="password">Mật khẩu</label>
                <input type="text" name="password" class="form-control">
            </div>
            <div class="form-group mt-3">
                <label for="image">Email</label>
                <input type="text" id="email" name="email" class="form-control">
            </div>
            <div class="form-group mt-3">
                <label for="role_id">Vai trò</label><br>
                <select name="role_id" id="role_id" class="form-select w-100">
                    <option selected value="">Chọn vai trò</option>
                    <option value="1">Admin</option>
                    <option value="2">Người dùng</option>
                </select>
            </div>
            <input type="submit" name="submit" value="Add" class="btn btn-success">
        </form>
    </div>