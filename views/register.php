<?php 
session_start();

//db conn
require_once '../config/conn.php';
//take class user
require_once '../classes/User.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $conn = new mysqli($servername, $username, $password, $db);

    $user = new User($conn);
    $user->setUsername($_POST['username']);
    $user->setPassword($_POST['password']);
    $user->setEmail($_POST['email']);
    $user->setFirstName($_POST['name']);
    $user->setLastName($_POST['surname']);
    $user->setRoleId(1);

     // Registra l'utente e gestisci il risultato
     $result = $user->register();

     if ($result == 'email_exists') {
         header("Location: register.php?error=email_exists");
     } elseif ($result == 'success') {
         header("Location: login.php");
     } else {
         header("Location: register.php?error=error");
     }
     exit();

}


//script for registration





require_once '../components/head.php';
require_once '../components/nav.php';
?>

<section class="register">
    <div class="containerForm">
        <div class="leftRegister"></div>

        <form action="register.php" method="post">

            <h2>Register</h2>

            <div class="inputContainer">
                <input type="text" name="username" id="username" placeholder="Username" required>
            
                <input type="password" name="password" id="password" placeholder="Password" required>
            
                <input type="email" name="email" id="email" placeholder="Email" required>
            
                <input type="text" name="name" id="name" placeholder="Name" required>
            
                <input type="text" name="surname" id="surname" placeholder="Surname" required>
            
                <button type="submit">Registrati</button>
            
            </div>
        
        </form>
    </div>
</section>

<?php
    if (isset($_GET['error'])) {
        if ($_GET['error'] == 'email_exists') {
            echo "<p style='color:red;'>Email già esistente. Scegli un'altra email.</p>";
        } else {
            echo "<p style='color:red;'>Errore durante la registrazione. Riprova.</p>";
        }
    }
?>






<?php require_once '../components/footer.php'; ?>