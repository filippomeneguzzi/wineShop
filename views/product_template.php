<?php
require_once '../config/conn.php';
require_once '../classes/Product.php';
require_once '../classes/Category.php';


require_once '../components/head.php';
require_once '../components/nav.php';

$conn = new mysqli($servername, $username, $password, $db);


$msg_error = "";

//verifico se c'è id nella url.
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($product_id > 0) {

    //creo oggetto per prendere i dettagli prodotto tramite id
    $product = new Product($conn);
    $product_details = $product->getProductById($product_id);

    //creo l'oggetto per vedere le categorie
    $category = new Category($conn);
    $categories = $category->getAllCategories();

} else {
    die("ID prodotto non valido.");
}


?>



<!-- VISUALIZZA PRODOTTO -->
<?php if ($product_details): ?>
        <div class="product-detail">
            <div class="imageTemplate">
                <?php if (!empty($product_details['image'])): ?>
                    <img src="../<?php echo htmlspecialchars($product_details['image']); ?>" alt="<?php echo htmlspecialchars($product_details['name']); ?>" style="max-width: 300px;">
                <?php endif; ?>
            </div>

            <div class="detailTemplate">
                <h2><?php echo htmlspecialchars($product_details['name']); ?></h2>
                <p><?php echo htmlspecialchars($product_details['description']); ?></p>
                <p>Categoria: <?php echo htmlspecialchars($product_details['category_name']); ?></p>
                <p>Prezzo: €<?php echo htmlspecialchars($product_details['price']); ?></p>

                <form action="add_to_cart.php" method="post">
                    <input type="hidden" name="product_id" value="<?php echo $product_id;?>">
                    <button type="submit">Aggiungi al carrello</button>
                </form>
                <?php if(isset($_SESSION['role_id']) && $_SESSION['role_id'] == 2): ?>
                    <form action="delete_product.php" method="post">
                        <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product_details['id']); ?>">
                        <button type="submit">Elimina prodotto</button>
                    </form>
                <?php endif; ?>
            </div>
            
        </div>
    <?php else: ?>
        <p>Prodotto non trovato.</p>
<?php endif; ?>








<?php require_once '../components/footer.php'; ?>
