<!DOCTYPE html>
<html lang="en">

<body>
    <nav class="py-0 navbar navbar-dark navbar-expand-sm d-flex justify-content-between bg-dark" style="height: 60px;">
        <ul class="navbar-nav h-100">
            <li class="nav-item d-flex align-items-center">
                <a href="index.php" class="nav-link">Trang chủ</a>
            </li>
            <li class="nav-item d-flex align-items-center">
                <a href="" class="nav-link">Sản phẩm</a>
                <ul class="subnav p-0">
                    <?php
                    require 'connect.php';
                    $sql = "SELECT * FROM categories where status = 'active'";
                    $result = mysqli_query($conn, $sql);
                    if (!$result) {
                        die('Query Error: ' . mysqli_error($conn));
                    }
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) { ?>
                            <li class="nav-item d-flex align-items-center">
                                <a href="product.php?category_id=<?php echo $row['category_id'] ?>" class="nav-link text-dark"><?php echo $row['name'] ?></a>
                            </li>
                    <?php
                        }
                    }
                    ?>
                </ul>
            </li>
            <li class="nav-item d-flex align-items-center">
                <a href="" class="nav-link">Giỏ hàng</a>
            </li>
        </ul>
        <ul class="navbar-nav h-100">
            <?php
            session_start();
            if (!isset($_SESSION['username'])) {
            ?>
                <li class="nav-item d-flex align-items-center">
                    <a href="signup.php" class="nav-link">Đăng ký</a>
                </li>
                <li class="nav-item d-flex align-items-center">
                    <a href="login.php" class="nav-link">Đăng nhập</a>
                </li>
            <?php
            } else {
            ?>
                <li class="nav-item d-flex align-items-center">
                    <a href="" class="nav-link"><?php echo $_SESSION['username'] ?></a>
                </li>
                <li class="nav-item d-flex align-items-center">
                    <a href="logout.php" class="nav-link">Đăng xuất</a>
                </li>
            <?php
            }
            ?>
            <form class="form-inline" action="product.php" method="get">
                <input class="form-control mr-sm-2 rounded-pill" type="search" placeholder="Search" name="name">
                <button class="btn btn-outline-success my-2 my-sm-0 rounded-pill" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </ul>
    </nav>
</body>

</html>