<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

include("../includes/header.php");
include("../includes/navbar.php");
include("../ajax/individual_blotter.php");



$id = filter_input(INPUT_GET,'id', FILTER_SANITIZE_NUMBER_INT);


// Call the individual method
$blotter = $blotter->individual($id);

?>




<div class="row">


    <div>
        <h1>View Blotter</h1>
    </div>


    <div>
        <?php

            // Check if data was fetched
            if ($blotter) {
                // Display the data in HTML
                echo "<h1>Blotter Details</h1>";
                echo htmlspecialchars($blotter['complainant_fname']); echo "<br>";
                echo htmlspecialchars($blotter['complainant_mname']); echo "<br>";
                echo htmlspecialchars($blotter['complainant_lname']); echo "<br>";
                echo htmlspecialchars($blotter['complainant_suffix']); echo "<br>";
                echo htmlspecialchars($blotter['complainant_address']); echo "<br>";
                echo htmlspecialchars($blotter['complainant_contact']); echo "<br>";
                echo htmlspecialchars($blotter['respondent_fname']); echo "<br>";
                echo htmlspecialchars($blotter['respondent_mname']); echo "<br>";
                echo htmlspecialchars($blotter['respondent_lname']); echo "<br>";
                echo htmlspecialchars($blotter['respondent_suffix']); echo "<br>";
                
            } else {
                echo "<p>No blotter found with the specified ID.</p>";
            }

        ?>
    </div>

</div>
    






<?php

include("../includes/footer.php");


?>