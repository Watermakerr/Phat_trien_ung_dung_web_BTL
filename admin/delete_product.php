<?php
require 'header.php';
if (isset($_POST['checkbox'])) {
    $ids = $_POST['checkbox'];
    if (!empty($ids)) {
        $ids = implode(',', array_map('intval', $ids));
        $sql = "DELETE FROM `products` WHERE product_id IN ($ids)";
        if ($conn->query($sql) !== TRUE) {
            header("Location: show_product.php?status=delete_error");
        } else {
            header("Location: show_product.php?status=delete_success");
        }
    }
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM `products` WHERE product_id = $id";
    if ($conn->query($sql) !== TRUE) {
        header("Location: show_product.php?status=delete_error");
    } else {
        header("Location: show_product.php?status=delete_success");
    }
}
?>