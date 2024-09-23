<?php
include_once '../config/conn.php';
/* include_once '../classes/Cart.php';
include_once '../classes/Product.php'; */
include_once '../classes/User.php';
include __DIR__ . '/../actions/functions.php';

$id = $_SESSION['user_id'];

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $password = !empty($_POST['password']) ? $_POST['password'] : null;

    $user = new User($conn);

    if($user->updateUser($id,$username, $email, $first_name, $last_name,$password)){
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['first_name'] = $first_name;
        $_SESSION['last_name'] = $last_name;

        header("Location: ../views/admin_dashboard.php");
        exit();
    }else{
        echo "errore";
    }
}

