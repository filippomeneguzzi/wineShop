<?php
session_start();

require_once '../config/conn.php';
require_once '../classes/User.php';


$username = $_SESSION['username'];
$email = $_SESSION['email'];
$first_name = $_SESSION['first_name'];
$last_name = $_SESSION['last_name'];

require_once '../components/head.php';
require_once '../components/nav.php';




?>


<section class="dashboarClient">
    <div class="intro">
        <h2>Hey, <?php echo $first_name." ".$last_name; ?></h2>
        <p><?php current_date() ?></p>
    </div>

    <div class="personal_data">
        <p>Email: <?php echo $email; ?> </p>
    </div>
</section>




<?php require_once '../components/footer.php'; ?>