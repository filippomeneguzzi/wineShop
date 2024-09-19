<?php

require_once '../config/conn.php';
require_once '../classes/Product.php';
require_once '../classes/Category.php';


include_once('../components/head.php');
include_once('../components/nav.php');

$msg_error = "";

$user_id = $_SESSION['user_id'] ?? null;
$cart_items = [];
$total_items = 0;


if($user_id){
    $cart = new Cart($conn, $user_id);
    $cart_Items = $cart->getItemsCart();

    foreach($cart_items as $item){
        $total_items += $item['quantity'];
    }
}else{
    $msg_error = "Devi essere loggato per vedere il carrello";
}
?>

<div class="cartPage">

    <h2 class="marginNav">Il tuo carrello</h2>

    <div class="cartProductView">
        <?php if(!empty($cart_Items)): ?>
            <ul class="ulCardProduct">
                <?php foreach($cart_Items as $item): ?>
                    <li class="card_productCartContainer">
                        <div class="cardCartProduct">
                            <div class="imgCartContainer">
                                <img class="imgCart" src="../<?php echo htmlspecialchars($item['image'])?>" alt="">
                            </div>

                            <div class="rightCardCart">

                                <div class="title_priceCard">
                                    <h4><?php echo htmlspecialchars($item['name']); ?></h4>
                                    <p>€<?php echo htmlspecialchars($item['price']); ?></p> <!-- - <?php echo htmlspecialchars($item['quantity']); ?> -->
                                </div>
    
                                <div class="btnCardCart">
                                    <form action="update_cart.php" method="post" class="formAdd">
                                        <select name="quantity" class="selectQt" onchange="this.form.submit()">
                                            <?php for($i = 1; $i <= 10; $i++): ?>
                                                <option value="<?php echo $i;?>" <?php echo $item['quantity'] == $i ? 'selected' : ''; ?>>
                                                    <?php echo $i; ?>
                                                </option>
                                                <?php endfor; ?>
                                            </select>
                                        <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($item['id']); ?>">
                                    </form>
                                    <form action="remove_cart.php" method="post" class="formRemove" >
                                        <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($item['id']); ?>">
                                        <button type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                <path d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>

                            </div>
        

                        </div>
                    </li>
        
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Carrello vuoto</p>
        <?php endif; ?>
    </div>
    
    
    <?php echo $msg_error; ?>
</div>






<?php 
     include_once('../components/footer.php');
?>
