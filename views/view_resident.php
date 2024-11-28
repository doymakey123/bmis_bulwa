<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

include("../includes/header.php");
include("../includes/navbar.php");
include("../ajax/individual_resident.php");



$id = filter_input(INPUT_GET,'id', FILTER_SANITIZE_NUMBER_INT);


// Call the individual method
$resident = $resident->individual($id);

?>




<div class="row">


    <div>
        <h1>View Resident</h1>
    </div>


    <div>
        <?php

            // Check if data was fetched
            if ($resident) {
                // Display the data in HTML
                echo "<h1>Resident Details</h1>";
                echo htmlspecialchars($resident['fname']); echo "<br>";
                echo htmlspecialchars($resident['mname']); echo "<br>";
                echo htmlspecialchars($resident['lname']); echo "<br>";
                echo htmlspecialchars($resident['suffix']); echo "<br>";
                echo htmlspecialchars($resident['gender']); echo "<br>";
                echo htmlspecialchars($resident['dob']); echo "<br>";
                echo htmlspecialchars($resident['civil_status']); echo "<br>";
                echo htmlspecialchars($resident['nationality']); echo "<br>";
                
            } else {
                echo "<p>No resident found with the specified ID.</p>";
            }

        ?>
    </div>

</div>
    






<?php

include("../includes/footer.php");


?>