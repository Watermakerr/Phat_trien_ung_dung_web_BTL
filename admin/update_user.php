<!DOCTYPE html>
<html lang="en">

<body>
    <?php
    require 'header.php';
    $id = $_GET['id'];
    $sql = "SELECT user_id, username, fullname, email, role_name FROM `users`
            INNER JOIN roles ON roles.role_id = users.role_id
            WHERE `user_id` = '$id'";
    $result = $conn->query($sql);
    if ($result->num_rows <= 0) {
        die("Record not found");
    } else {
        $row = $result->fetch_assoc();
    }
    ?>
    <div class="row">
        <div class="col-6 mx-auto my-5">
            <form action="" method="post" class="form-group">
                <h1 class="text-center">Update user</h1>
                <div class="form-group">
                    <label for="">Họ và tên</label>
                    <input type="text " name="fullname" class="form-control" value="<?php echo $row['fullname']; ?> ">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text " name="email" class="form-control" value="<?php echo $row['email']; ?> ">
                </div>
                <div class="form-group">
                    <label for="">Vai trò</label>
                    <select name="role_id" class="form-control">
                        <?php
                        $sql_roles = "SELECT * FROM roles";
                        $result_roles = $conn->query($sql_roles);
                        while ($row_roles = $result_roles->fetch_assoc()) {?>
                            <option value="<?php echo $row_roles['role_id'] ?>" ><?php echo $row_roles['role_name'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <input type="submit" name="submit" value="update" class="btn btn-success">
            </form>
        </div>
        <?php
        if (isset($_POST['submit'])) {
            $id = $_GET['id'];
            $fullname = $_POST['fullname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $role_id = $_POST['role_id'];
            $sql_1 = "UPDATE `users` SET fullname='$fullname', email='$email', password='$password', role_id='$role_id'
                     WHERE user_id = '$id'";
            if ($conn->query($sql_1) === TRUE) {
                echo "<script>alert('Record updated successfully')</script>";
                echo "<script>window.location.href = 'show_user.php'</script>";
            } else {
                echo "<script>alert('Error updating record')</script>";
            }
            $conn->close();
        }
        ?>
</body>

</html>