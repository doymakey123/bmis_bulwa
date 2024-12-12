<?php


session_start();
if ($_SESSION['role'] !== 'admin') {
    header('Location: ../views/login.php');
    exit;
}

include("../includes/header.php");
include("../includes/navbar.php");




?>


    <div class="container-fluid">


        <table class="table table-bordered mb-4" id="seniorTable" style="width: 100%">
            <thead>
                <tr>
                    <th>Seq. #</th>
                    <th>Complete Name</th>
                    <th>Age</th>
                    <th>Date of Birth</th>
                    <th>Gender</th>
                    <th>Employment Status</th>
                    <th>Civil Status</th>
                    <th>type of Dwelling</th>
                    <th>Beneficiary Program</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

    </div>




<script>

    $('#header_name_exchangeable').text('List of Senior Citizen'); // Change text description


</script>
<?php

include("../includes/footer.php");


?>