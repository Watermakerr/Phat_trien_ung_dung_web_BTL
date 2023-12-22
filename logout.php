<?php
session_start();
unset($_SESSION['username']);
unset($_SESSION['user_id']);
unset($_SESSION["role"]);
echo 'Bạn đã đăng xuất. <a href="index.php">Go back</a>';
?>