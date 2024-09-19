<?php

include_once '../config/conn.php';
include_once '../classes/Cart.php';
include __DIR__ . '/../actions/functions.php';


$product_id = intval($_POST['product_id']);
$user_id = $_SESSION['user_id'] ?? null;

if($user_id && $product_id){
    $cart = new Cart($conn, $user_id);
    $cart->removeProduct($product_id);
    header("Location: cart.php");
    exit();
}else{
    echo "ID user o product non trovato";
}


include_once('../components/footer.php');

?>