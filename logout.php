<?php
session_start();
session_destroy();
echo 'Bạn đã đăng xuất. <a href="index.php">Go back</a>';
?>