<?php

include_once '../config/conn.php';
include_once '../classes/Cart.php';
include __DIR__ . '/../actions/functions.php';


$product_id = intval($_POST['product_id']);
$quantity = intval($_POST['quantity']);
$user_id = $_SESSION['user_id'] ?? null;

if($user_id && $product_id && $quantity > 0){
    $cart = new Cart($conn, $user_id);
    $cart->updateProduct($product_id,$quantity);
}

header("Location: cart.php");
exit();
?>