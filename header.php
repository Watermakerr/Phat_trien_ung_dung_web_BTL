<!DOCTYPE html>
<html lang="en">
<body>
    <nav class=" py-0 navbar navbar-dark navbar-expand-sm d-flex justify-content-between bg-dark">
        <div>
            <ul class="navbar-nav ">
                <li class="nav-item">
                    <a href="index.php" class="nav-link">Trang chủ</a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link"></a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">Sản phẩm</a>
                    <ul class="subnav bg-white p-0">
                        <li class="nav-item"><a href="" class="nav-link text-dark">Danh mục</a></li>
                        <li class="nav-item"><a href="" class="nav-link text-dark">Danh mục</a></li>
                        <li class="nav-item"><a href="" class="nav-link text-dark">Danh mục</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">Giỏ hàng</a>
                </li>
            </ul>
        </div>
        <form class="form-inline" action="product.php" method="get">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="name">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        <div class="">
            <ul class="navbar-nav">
                <?php
                session_start();
                if (!isset($_SESSION['username'])) {
                ?>
                    <li class="nav-item">
                        <a href="signup.php" class="nav-link">Đăng ký</a>
                    </li>
                    <li class="nav-item">
                        <a href="login.php" class="nav-link">Đăng nhập</a>
                    </li>
                <?php
                } else {
                ?>
                    <li class="nav-item">
                        <a href="" class="nav-link"><?php echo $_SESSION['username'] ?></a>
                    </li>
                    <li class="nav-item">
                        <a href="logout.php" class="nav-link">Đăng xuất</a>
                    </li>
                <?php
                }
                ?>
            </ul>
        </div>
    </nav>
</body>

</html>