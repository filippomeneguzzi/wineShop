<?php 
session_start();

//db conn
require_once '../config/conn.php';

$username = $_SESSION['username'];
$email = $_SESSION['email'];
$first_name = $_SESSION['first_name'];
$last_name = $_SESSION['last_name'];


require_once '../components/head.php';
require_once '../components/nav.php';?>

<section class="dashboardHome">
    <div class="intro">
        <h2>Hey, <?php echo $first_name." ".$last_name; ?></h2>
        <p><?php current_date() ?></p>
    </div>
    <div class="data_view">
        <div class="totRevenue containerDataDashboard">
            <h3>Vendite totali</h3>
            <p>€ 10</p>
        </div>
        <div class=" containerDataDashboard">
            <h3>Ordini</h3>
            <p>120</p>
        </div>
        <div class=" containerDataDashboard">
            <h3>Clienti</h3>
            <p>340</p>
        </div>
    </div>
</section>




<?php require_once '../components/footer.php'; ?>