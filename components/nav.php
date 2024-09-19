<?php 
    include __DIR__ . '/../actions/functions.php';
    include __DIR__ . '/../classes/Cart.php';



    if (isset($_SESSION['user_id'])) {
        $cart = new Cart($conn, $_SESSION['user_id']);
        $cart_items = $cart->getItemsCart();
        $cart_count = array_sum(array_column($cart_items, 'quantity'));
    } else {
        $cart_count = 0;
    }
 ?>

<nav id="navbar">
    <ul class="links_left">
        <a href="">Home</a>
        <a href="">Home</a>
    </ul>

    <a href="../index.php" class="logoLink"><h2 class="logo">Wine</h2></a>

    <div class="link_container">
        <ul class="links_right">
            <a href="../index.php" class="link">Home</a>
            <a href="../views/shop.php" class="link">Shop</a>
            <a href="../views/cart.php" class="link">Cart</a>
        <?php if(isset($_SESSION['role_id']) && $_SESSION['role_id'] == 2): ?>
            <a href="../views/createProduct.php">Product Page</a>
            <a href="../views/admin_dashboard.php">Dashboard</a>
        <?php elseif(isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1): ?>
            <a href="../views/user_home.php">Account</a>
        <?php endif; ?>
        <?php if(logged_in()): ?>
            <a href="../actions/logout.php" class="link">Logout</a>
        <?php else: ?> 
            <a href="../views/login.php" class="link">Login</a>   
            <a href="../views/register.php" class="link">Register</a>    
        <?php endif; ?>
        </ul>
    </div>

   
    <div class="rightNav">
        <div class="cart">
            <a href="../views/cart.php">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M0 24C0 10.7 10.7 0 24 0L69.5 0c22 0 41.5 12.8 50.6 32l411 0c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3l-288.5 0 5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5L488 336c13.3 0 24 10.7 24 24s-10.7 24-24 24l-288.3 0c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5L24 48C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg>
                <span id="cart_count"><?php echo $cart_count; ?></span>
            </a>
        </div>


        <div id="hamburger">

            <span class="line"></span>
            <span class="line line2"></span>
            <span class="line"></span>
        </div>
    </div>
</nav>