<?php
require_once '../config/conn.php';
require_once '../classes/Product.php';
require_once '../classes/Category.php';


require_once '../components/head.php';
require_once '../components/nav.php';



$product = new Product($conn);
$products = $product->getProductDetails();



?>

<section class="allProductsShop">
    <h2>I nostri prodotti</h2>

    <div class="showProd">
        <?php foreach($products as $product): ?>
            <div class="card">
                <div class="card_image">
                    <img src="../<?php echo htmlspecialchars($product['image']) ?>" alt="<?php echo htmlspecialchars($product['name']) ?>">
                </div>
                <div class="cardTxt">
                    <h3><?php echo htmlspecialchars($product["name"]); ?></h3>
                    <p><?php echo htmlspecialchars(limitWords($product["description"])); ?></p>
                    <p><?php echo htmlspecialchars($product["category_name"]); ?></p>
                    <p><?php echo htmlspecialchars($product["price"]); ?>€</p>
    
                    <?php echo "<a href='product_template.php?id=" . $product["id"] . "'>Scopri di più</a>" ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</section>


<?php require_once '../components/footer.php'; ?>