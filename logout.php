<?php
session_start();
unset($_SESSION['username']);
unset($_SESSION['user_id']);
unset($_SESSION["role_id"]);
header('Location: index.php');
?>v 