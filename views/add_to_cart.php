<?php 

include_once '../config/conn.php';


include_once('../components/head.php');
include_once('../components/nav.php');

$product_id = intval($_POST['product_id']);
$user_id = $_SESSION['user_id'] ?? null;


if($product_id && $user_id){
    $cart = new Cart($conn, $user_id);
    $cart->addProduct($product_id);
    header('Location: cart.php');
    exit();
}else{
    echo "ID user o product non trovato";
}

?>





<?php 
     include_once('../components/footer.php');
?>