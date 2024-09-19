<?php
session_start();

//verifico l'utente della sessione
if(isset($_SESSION['username'])){
    $_SESSION = [];

    

    //distruggo e reindirizzo
    session_destroy();
    header('Location: ../index.php');
    exit();
}


