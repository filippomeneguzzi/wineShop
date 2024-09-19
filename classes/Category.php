<?php

class Category{

    private $conn;
    public $id;
    public $name;


    public function __construct($conn){
        $this-> conn = $conn;
    }

    //get e setters
    public function getId(){
        return $this-> conn;
    }
    public function setId($id){
        $this-> id = $id;
    }

    public function getName(){
        return $this-> name;
    }
    public function setName($name){
        $this-> name = $name;
    }

    // Create category
    public function createCategory() {
        $stmt = $this->conn->prepare("INSERT INTO categories (name) VALUES (?)");
        $stmt->bind_param("s", $this->name);
        return $stmt->execute() ? 'success' : 'error';
    }

    public function getAllCategories() {
        $query = "SELECT id, name FROM categories";
        $result = $this->conn->query($query);

        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }


}

?>