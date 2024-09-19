<?php


class Cart{
    private $conn;
    private $user_id;

    public function __construct($conn, $user_id){
        $this->conn = $conn;
        $this->user_id = $user_id;
    }

    public function addProduct($product_id, $quantity = 1){
        //Vedo se ci sono dei prodotti nel carrello
        $stmt = $this->conn->prepare("SELECT id, quantity FROM cart WHERE product_id = ? AND user_id = ?");
        $stmt->bind_param("ii", $product_id, $this->user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        //se ci sono li aggiorniamo
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $new_quantity = $row['quantity'] + $quantity;
            $stmt = $this->conn->prepare("UPDATE cart SET quantity = ? WHERE product_id = ? AND user_id = ?");
            $stmt->bind_param("iii", $new_quantity, $product_id, $this->user_id);
            return $stmt->execute();
        }else{
            //se non c'è lo aggiungo
            $stmt = $this->conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
            $stmt->bind_param("iii", $this->user_id, $product_id, $quantity);
        }

        $stmt->execute();
    }

    public function getItemsCart(){
        //prendiamo i prodotti nel carrello
        $stmt = $this->conn->prepare("
            SELECT p.id, p.name, p.image, p.price, c.quantity 
            FROM products p
            JOIN cart c ON p.id = c.product_id
            WHERE c.user_id = ?
        ");
        $stmt->bind_param("i", $this->user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $cart_items = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $cart_items;
    }


    public function updateProduct($product_id, $quantity){
        $stmt = $this->conn->prepare("UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ?");
        $stmt->bind_param("iii", $quantity, $this->user_id, $product_id);
        $stmt->execute();
        $stmt->close();
    }

    public function removeProduct($product_id){
        $stmt = $this->conn->prepare("DELETE FROM cart WHERE user_id = ? AND product_id = ?");
        $stmt->bind_param("ii", $this->user_id, $product_id);
        $stmt->execute();
        $stmt->close();
    }

   
}






 
 
