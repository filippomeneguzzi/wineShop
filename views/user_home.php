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


<section class="dashboardHome">
    <div class="intro">
        <h2>Hey, <?php echo $first_name." ".$last_name; ?></h2>
        <p><?php current_date() ?></p>
    </div>
    <div class="changeData">
        <h2 style="text-align: center;">Aggiorna i tuoi dati</h2>
        <form action="updateAdmin.php" method="post">

            <div class="leftData">
                <div class="updateSectionInput">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username) ?>">
                </div>
                <div class="updateSectionInput">
                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($email) ?>">
                </div>
                <div class="updateSectionInput">
                    <label for="password">Password:</label>
                    <input type="text" id="password" name="password">
                </div>
            </div>

            <div class="rightData">
                <div class="updateSectionInput">
                    <label for="first_name">Nome:</label>
                    <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($first_name) ?>">
                </div>
                <div class="updateSectionInput">
                    <label for="last_name">Cognome:</label>
                    <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($last_name) ?>">
                </div>
                <div class="">
                    <button type="submit">Aggiorna</button>
                </div>
            </div>
        </form>
    </div>
</section>




<?php require_once '../components/footer.php'; ?>