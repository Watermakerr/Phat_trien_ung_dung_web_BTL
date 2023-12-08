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
    <div class="container">
        <div class="row">
            <div class="col-6 mx-auto my-5">
                <form action="confirmsignup.php" method="POST">
                    <h2 class="text-center">Trang đăng ký</h2>
                    <div class="form-group">
                        <label for="name">Họ và tên</label>
                        <input type="text" name="fullname" id="fullname" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="username">Tên đăng nhập</label>
                        <input type="username" name="username" id="username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Mật khẩu</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="rePassword">Nhập lại mật khẩu</label>
                        <input type="password" name="rePassword" id="rePassword" class="form-control">
                    </div>
                    <input name="submit" type="submit" class="btn btn-primary" id="submit" value="Tạo tài khoản"></input>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var fullname = document.querySelector('#fullname');
            var username = document.querySelector('#username');
            var email = document.querySelector('#email');
            var password = document.querySelector('#password');
            var rePassword = document.querySelector('#rePassword');
            var submitButton = document.querySelector('#submit');

            function checkInput() {
                if (!fullname.value || !username.value || !password.value || !rePassword.value ||!email.value) {
                    submitButton.disabled = true;
                } else {
                    submitButton.disabled = false;
                }
                if (password.value != rePassword.value) {
                    var alert = document.querySelector('.alert');
                    if (!alert) {
                        var text = document.createElement('p');
                        text.innerHTML = "Mật khẩu không khớp";
                        text.classList.add('alert', 'alert-danger', 'mt-2');
                        rePassword.parentNode.appendChild(text);
                    }
                    submitButton.disabled = true;
                } else {
                    var alert = document.querySelector('.alert');
                    if (alert) {
                        alert.remove();
                    }
                }
            }

            fullname.addEventListener('input', checkInput);
            username.addEventListener('input', checkInput);
            email.addEventListener('input', checkInput);
            password.addEventListener('input', checkInput);
            rePassword.addEventListener('input', checkInput);

            // Initial check in case the form is autofilled
            checkInput();
        })
    </script>

</body>

</html>