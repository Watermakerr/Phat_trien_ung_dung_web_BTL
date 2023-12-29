<?php
require_once 'header.php';
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
};
if (isset($_POST['submit'])) {
    $currentPassword = $_POST['currentPassword'];
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $_SESSION['username']);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $hashedPassword = $row['password'];
    if (password_verify($currentPassword, $hashedPassword)) {
        $newPassword = $_POST['newPassword'];
        $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
        $stmt->bind_param("ss", $hashedNewPassword, $_SESSION['username']);
        $stmt->execute();
        echo "<script>alert('Đổi mật khẩu thành công'); window.location.href = 'index.php';</script>";
    } else {
        $error = "Sai mật khẩu";
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