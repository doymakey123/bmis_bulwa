<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

include("../includes/header.php");
include("../includes/navbar.php");

?>





<h1>Welcome, Admin!</h1>
    






<?php

include("../includes/footer.php");

?>