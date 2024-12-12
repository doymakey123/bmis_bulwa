<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}





include("../includes/header.php");
include("../includes/navbar.php");

include("../ajax/fetch_dashboard.php");
// Call the function to get the count of residents aged 60 and up
// $total_60_and_up = $resident->countResidents60AndUp();



?>





<h1>Welcome, Admin!</h1>
<br><br>

<div class="container">
    <div class="row">
    <a href="senior_citizen.php">
        <p>total senior citizen(s) <?php echo $total_60_and_up; ?></p>
    </a>
    </div>
    <div class="row">
    <p>total female <?php echo $total_female; ?></p>
    </div>
    <div class="row">
    <p>total male <?php echo $total_male; ?></p> 
    </div>
    <div class="row">
    <p>total resident(s) <?php echo $total_resident; ?></p> 
    </div>
</div>
    






<?php

include("../includes/footer.php");

?>