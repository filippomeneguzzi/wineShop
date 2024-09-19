<?php 

//db conn
require_once '../config/conn.php';
//take class user
require_once '../classes/User.php';


require_once '../components/head.php';
require_once '../components/nav.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $conn = new mysqli($servername, $username, $password, $db);

   $user = new User($conn);
   $username = $_POST['username'];
   $password = $_POST['password'];

   if($user->login($username, $password)) {
    }

    $conn->close();
}
?>


<section class="loginPage">
    <div class="containerForm">

        <form action="login.php" method="post" >
            <h2>Login</h2>

            <div class="inputContainer">
                <input type="text" name="username" id="username" placeholder="Username" required>
                
                <input type="password" name="password" id="password" placeholder="Password" required>
                
                <p><?php echo $msg_error; ?></p>
                
                <button type="submit">Login</button>
            </div>
        </form>


        <div class="rightLogin"></div>
    </div>

</section>







<?php require_once '../components/footer.php'; ?>