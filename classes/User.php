<?php 

//variable msg_error use for errors
$msg_error = "";


class User{
    private $conn;
    public $id;
    public $username;
    public $password;
    public $email;
    public $first_name;
    public $last_name;
    public $role_id;

    
    public function __construct($conn){
        $this->conn = $conn;
    }

    //get e setter method

    //get read element
    public function getId(){
        return $this -> id;
    }

    //set modify value
    public function setId($id){
        $this->id = $id;
    }

    public function getUsername(){
        return $this -> username;
    }

    public function setUsername($username){
        $this->username = $username;
    }

    public function getPassword(){
        return $this -> password;
    }
    
    //hash della password
    public function setPassword($password){
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    public function getEmail(){
        return $this-> password;
    }

    public function setEmail($email){
        $this -> email = $email;
    }
    
    public function getFirstName(){
        return $this-> first_name;
    }
    public function setFirstName($first_name){
        $this -> first_name = $first_name;
    }
    public function getLaststName(){
        return $this-> last_name;
    }
    public function setLastName($last_name){
        $this -> last_name = $last_name;
    }

    public function setRoleId($role_id) {
        $this->role_id = $role_id;
    }



    //methods important
    public function register(){
        //check email exists
        if($this->emailExists()){
            return 'email_exists';
        }
        if($this -> usernameExists()){
            return 'username_exists';
        }

        $stmt = $this->conn->prepare("INSERT INTO users (username, password, email, first_name, last_name, role_id) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssi", $this->username, $this->password, $this->email, $this->first_name, $this->last_name, $this->role_id);
        return $stmt->execute() ? 'success' : 'error';
    }


    public function emailExists(){
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $this->email);
        $stmt-> execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }

    public function usernameExists(){
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $this->username);
        $stmt-> execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }

    //function for login
    public function login($username, $password) {
        //rendo globale la variabile
        global $msg_error;

        $stmt = $this->conn->prepare("SELECT id, password, role_id, first_name, last_name, email FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $hashed_password, $role_id, $first_name, $last_name, $email);
            $stmt->fetch();

            if (password_verify($password, $hashed_password)) {
                //mi salvo i dati nella sessione
                session_start();
                session_regenerate_id();

                $this->id = $id;
                $this->username = $username;
                $this->role_id = $role_id;
                $_SESSION['user_id'] = $this->id;
                $_SESSION['username'] = $this->username;
                $_SESSION['role_id'] = $this->role_id;
                $_SESSION['first_name'] = $first_name;
                $_SESSION['last_name'] = $last_name;
                $_SESSION['email'] = $email;


                //verifico ruolo e reindirizzo
                if ($role_id == 2) {
                    header("Location: admin_dashboard.php");
                } else {
                    header("Location: user_home.php");
                }
                exit();
            } else {
                $msg_error = "Password errata";
            }
        } else {
            $msg_error = "Nessun utente trovato con questo username";
        }
        return false;
    }

    //change password
    public function changhePassword(){
        
    }

}
?>