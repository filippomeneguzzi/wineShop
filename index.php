<?php 
include_once 'config/conn.php';
include_once 'classes/Product.php';
include_once 'classes/Category.php';

include_once('components/head.php');
include_once('components/nav.php');



?>
    <header>
        <div class="centerContaienr">
            <h1>Autentico gusto <br> italiano</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
        </div>
    </header>



    <?php
        $product = new Product($conn);
        $products = $product->getProductHome();


        $category = new Category($conn);
        $categories = $category->getAllCategories();
    ?>

    <!-- wine section -->
    <section class="wineSection">
        <h2>I nostri vini</h2>

        <div class="containerWine">
            <?php foreach($products as $product) : ?>
                <div class="card">
                    <div class="card_image">
                        <img src="../<?php echo htmlspecialchars($product["image"]); ?>" alt="../<?php echo htmlspecialchars($product["name"]); ?>">
                    </div>
                    <div class="cardTxt">
                        <h3><?php echo htmlspecialchars($product["name"]); ?></h3>
                        <p><?php echo htmlspecialchars(limitWords($product["description"])); ?></p>
                        <p><?php echo htmlspecialchars($product["category_name"]); ?></p>
                        <p><?php echo htmlspecialchars($product["price"]); ?>€</p>

                        <?php echo "<a href='views/product_template.php?id=" . $product["id"] . "'>Scopri di più</a>" ?>
                    </div>
                </div>
            <?php endforeach; ?>
        
        </div>

    </section>

    <section class="chiSiamo">
        <div class="imgChiSiamo_Container">
            <img class="chiSiamoImg" src="https://www.informatoreagrario.it/wp-content/uploads/2017/05/grappolo-uva-rossa-vite.jpg" alt="">
        </div>

        <div class="chiSiamoContainer">
                <h2>Chi Siamo</h2>
                <div class="chiSiamoTxt">
                    <p>Fondata nel 1940, la nostra azienda vinicola è il frutto di una passione tramandata da generazioni.
                         Da oltre 80 anni, ci dedichiamo alla coltivazione delle nostre vigne e alla produzione di vini di alta qualità,
                         rispettando la tradizione ma abbracciando l’innovazione. Ogni bottiglia racconta una storia di territorio,
                         cura e attenzione per i dettagli, esprimendo l’essenza del nostro terroir unico. Crediamo nell'importanza della
                         sostenibilità e dell’eccellenza, e lavoriamo quotidianamente per offrire vini che rappresentano il meglio della
                         nostra terra, continuando a onorare la nostra lunga storia e guardando con entusiasmo al futuro.</p>
                </div>
        </div>
    </section>



<?php 
    include_once('components/footer.php');
?>

