<?php 

class Product{
    
    //proprietà
    private $conn;
    public $id;
    public $name;
    public $description;
    public $price;
    public $image;
    public $quantity;
    public $category_id;


    public function __construct($conn){
        $this-> conn = $conn;
    }

    public function getId(){
        return $this-> id;
    }
    public function setId($id){
        $this -> id = $id;
    }

    public function getName(){
        return $this-> name;
    }
    public function setName($name){
        $this -> name = $name;
    }

    public function getDescription(){
        return $this-> description;
    }
    public function setDescription($description){
        $this -> description = $description;
    }
    
    public function getPrice(){
        return $this-> price;
    }
    public function setPrice($price){
        $this -> price = $price;
    }

    public function getImage(){
        return $this-> image;
    }
    public function setImage($image){
        $this -> image = $image;
    }

    public function getQuantity(){
        return $this-> quantity;
    }
    public function setQuantity($quantity){
        $this -> quantity = $quantity;
    }

    public function getCategory_id(){
        return $this-> category_id;
    }
    public function setCategory_id($category_id){
        $this -> category_id = $category_id;
    }


    //methods


    //create products
    public function createProduct(){
        $stmt = $this->conn->prepare("INSERT INTO products (name, description, price, image, quantity, category_id) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdsii", $this->name, $this->description, $this->price, $this->image, $this->quantity,$this->category_id);
        return $stmt->execute() ? 'success' : 'error';

    }
    public function deleteProduct($product_id){
        $stmt = $this->conn->prepare("DELETE FROM products WHERE id=?");
        $stmt->bind_param("i", $product_id);
        return $stmt->execute() ? 'success' : 'error';
    }
    

    //take all products
    public function getProductDetails() {

        //così ho fatto un join e mi sono preso il nome della categoria
        $query = "SELECT p.id, p.name, p.description, p.price, p.image, p.quantity, c.name AS category_name
            FROM products p
            JOIN categories c ON p.category_id = c.id";
        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        $result = $stmt->get_result();
        if($result->num_rows > 0){
            return $result->fetch_all(MYSQLI_ASSOC);
        }else{
            return [];
        }
    }

    //get single product by id url
    public function getProductById($id){
        $query = "SELECT p.id, p.name, p.description, p.price, p.quantity, p.image, c.name AS category_name 
            FROM products p 
            JOIN categories c ON p.category_id = c.id 
            WHERE p.id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
        
    }

    //get product for homePage
    public function getProductHome(){
        $query = "SELECT p.id, p.name, p.description, p.price, p.image, p.quantity, c.name AS category_name
        FROM products p
        JOIN categories c ON p.category_id = c.id
        LIMIT 4";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        $result = $stmt->get_result();
        if($result->num_rows > 0){
            return $result->fetch_all(MYSQLI_ASSOC);
        }else{
            return[];
        }
    }

}