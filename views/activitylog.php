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

        <table class="table table-bordered" id="activitylogTable" style="width: 100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>User Type</th>
                    <th>Activity Type</th>
                    <th>Description</th>
                    <th>Date Created</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

    </div>




    <script src="../assets/js/activitylog_script.js"></script>

<?php

include("../includes/footer.php");

?>