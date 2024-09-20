<?php

require_once '../config/conn.php';
require_once '../classes/Product.php';
require_once '../classes/Category.php';

$msg_error = "";


if($_SERVER['REQUEST_METHOD'] == 'POST'){

    //stabilisco la connessione
    $conn = new mysqli($servername, $username, $password, $db);

    // take essentials methods
    $product = new Product($conn);
    $product->setName($_POST['name']);
    $product->setDescription($_POST['description']);
    $product->setPrice($_POST['price']);
    $product->setQuantity($_POST['quantity']);
    $product->setCategory_id($_POST['category_id']);

    $uploadOK = 1;
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // Cambia il percorso della cartella uploads
        $targetDir = __DIR__ . "/../uploads/";
        $targetFile = $targetDir . basename($_FILES['image']['name']);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if file is an actual image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOK = 1;
        } else {
            $msg_error = "File is not an image.";
            $uploadOK = 0;
        }

        // Check if file already exists
        if (file_exists($targetFile)) {
            $msg_error = "Sorry, file already exists.";
            $uploadOK = 0;
        }

        // Check file size
        if ($_FILES["image"]["size"] > 5000000) {
            $msg_error = "Sorry, your file is too large.";
            $uploadOK = 0;
        }

        // Allow certain file formats
        $allowedTypes = array("jpg", "jpeg", "png", "gif", "webp");
        if (!in_array($imageFileType, $allowedTypes)) {
            $msg_error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOK = 0;
        }

        if ($uploadOK == 1) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                $msg_error = "The file ". htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
                $relativePath = "uploads/" . basename($_FILES["image"]["name"]);
                $product->setImage($relativePath);
            } else {
                $msg_error = "Sorry, there was an error uploading your file.";
                $uploadOK = 0;
            }
        } else {
            $msg_error = "Sorry, your file was not uploaded.";
        }
    }else {
        $msg_error = "No file was uploaded or there was an error with the file.";
        $uploadOK = 0;
    }


    //db inserimento dopo i vari chek
    if($uploadOK == 1) {
        if ($product->createProduct() == 'success') {
            header('Location: createProduct.php');
            exit();
        } else {
            $msg_error = "Errore nella creazione del prodotto: " . $product->createProduct();
        }
    }

    
}

// Recupera le categorie per il menu a tendina
$category = new Category($conn);
$result = $conn->query("SELECT id, name FROM categories");
$categories = $result->fetch_all(MYSQLI_ASSOC);


//call components
require_once '../components/head.php';
require_once '../components/nav.php';


?>


<section class="formCreateProduct">
    <form action="createProduct.php" class="marginNav" method="post" enctype="multipart/form-data">
        <input type="text" name="name" id="name" placeholder="Name" required>
        <textarea type="text" name="description" id="description" placeholder="Description" required></textarea>
        <input type="number" step="0.1" name="price" id="price" placeholder="Price" required>
        <input type="number" name="quantity" id="quantity" placeholder="Quantity" required>
        <select name="category_id" id="category_id" required>
            <?php foreach($categories as $category):?>
                <option value="<?php echo $category['id'] ;?>"><?php echo $category['name'] ;?></option>
            <?php endforeach; ?>
        </select>
        <input type="file" name="image" id="image">

        <p><?php echo $msg_error;?></p>

        <button type="submit">Create product</button>

    </form>
</section>


<?php
    $product = new Product($conn);
    $products = $product->getProductDetails();
?>

   <!-- wine section -->
   <section class="showProd">

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
                        <p><?php echo htmlspecialchars($product["quantity"]); ?>€</p>
                        <p><?php echo htmlspecialchars($product["price"]); ?>€</p>

                        <?php echo "<a href='product_template.php?id=" . $product["id"] . "'>Scopri di più</a>" ?>
                    </div>
                </div>
            <?php endforeach; ?>
        
        </div>

    </section>


<?php require_once '../components/footer.php'; ?>