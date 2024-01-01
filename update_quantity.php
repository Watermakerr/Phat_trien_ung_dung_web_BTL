<?php
session_start();

$id = $_POST['id'];
$quantity = $_POST['quantity'];

$_SESSION['cartItem'][$id]['quantity'] = $quantity;

$itemTotal = $_SESSION['cartItem'][$id]['price'] * $quantity;
$itemPrice = $_SESSION['cartItem'][$id]['price'];

// Update total in the session
$_SESSION['cartItem'][$id]['total'] = $itemTotal;

$cartTotal = 0;
foreach ($_SESSION['cartItem'] as $item) {
    $cartTotal += $item['total'];
}

echo json_encode([
    'itemTotal' => number_format($itemTotal),
    'itemPrice' => number_format($itemPrice),
    'cartTotal' => number_format($cartTotal),
]);
?>