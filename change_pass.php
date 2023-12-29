<?php
require_once 'header.php';
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
};
if (isset($_POST['submit'])) {
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($newPassword == $confirmPassword) {
        // Replace 'your_database_connection' with your actual database connection variable
        $sql = "UPDATE users SET password='$newPassword' WHERE password='$currentPassword'";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            die('Query Error: ' . mysqli_error($conn));
        }
        if (mysqli_affected_rows($conn) > 0) {
            echo "<script>" .
                "alert('Đổi mật khẩu thành công');".
                "window.location.href='index.php';".
                "</script>";
        } else {
            $error = "Mât khẩu hiện tại không đúng";
        }
    }
}
?>
<div class="container">
    <div class="row">
        <div class="col-6 mx-auto my-5">
            <?php
            if (isset($error)) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
            ?>
            <form action="" method="POST" id="passwordForm">
                <h2 class="text-center">Đổi mật khẩu</h2>
                <div class="form-group">
                    <label for="currentPassword">Mật khẩu hiện tại</label>
                    <input type="password" name="currentPassword" id="currentPassword" class="form-control">
                </div>
                <div class="form-group">
                    <label for="newPassword">Mật khẩu mới</label>
                    <input type="password" name="newPassword" id="newPassword" class="form-control">
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Nhập lại mật khẩu mới</label>
                    <input type="password" name="confirmPassword" id="confirmPassword" class="form-control">
                </div>
                <input name="submit" type="submit" class="btn btn-primary" id="submit" value="Đổi mật khẩu"></input>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var currentPassword = document.querySelector('#currentPassword');
        var newPassword = document.querySelector('#newPassword');
        var confirmPassword = document.querySelector('#confirmPassword');
        var submitButton = document.querySelector('#submit');

        function checkInput() {
            if (!currentPassword.value || !newPassword.value || !confirmPassword.value) {
                submitButton.disabled = true;
            } else {
                submitButton.disabled = false;
            }
            const passwordAlert = document.querySelector('.password-alert');
            if (newPassword.value != confirmPassword.value) {
                if (!passwordAlert) {
                    var text = document.createElement('p');
                    text.innerHTML = "Mật khẩu không khớp";
                    text.classList.add('alert', 'alert-danger', 'mt-2', 'password-alert');
                    confirmPassword.parentNode.appendChild(text);
                }
                submitButton.disabled = true;
            } else if (passwordAlert) {
                passwordAlert.remove();
            }
        }

        currentPassword.addEventListener('input', checkInput);
        newPassword.addEventListener('input', checkInput);
        confirmPassword.addEventListener('input', checkInput);

        checkInput();
    });
</script>