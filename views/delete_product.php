<?php

include_once '../config/conn.php';
include_once '../classes/Cart.php';
include_once '../classes/Product.php';
include __DIR__ . '/../actions/functions.php';

$product_id = intval($_POST['product_id']);

if($product_id){
    $product = new Product($conn);
    if($product->deleteProduct($product_id)){
        header('Location: ../views/admin_dashboard.php');
        exit;
    }
}