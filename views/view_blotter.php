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






    <div class="container-fluid">

        <div class="row">   
                <div class="col-md-5">
                    <div class="form-group">
                        <label class="font-weight-bold" for="complainant_fname">Complainant Name:</label>
                        <input type="text" class="form-control" id="complainant_fname" name="complainant_fname" value="<?php echo htmlspecialchars($blotter['complainant_fname'] . ' ' . $blotter['complainant_mname'] . ' ' . $blotter['complainant_lname'] . ' ' . $blotter['complainant_suffix']);?>" disabled>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="font-weight-bold" for="fname">Complainant Address:</label>
                        <input type="text" class="form-control" id="fname" name="fname" value="<?php echo htmlspecialchars($blotter['complainant_address']);?>" disabled>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="font-weight-bold" for="mname">Complainant Contact #:</label>
                        <input type="text" class="form-control" id="mname" name="mname" value="<?php echo htmlspecialchars($blotter['complainant_contact']);?>" disabled>
                    </div>
                </div>
        </div> 

        <div class="row">   
                <div class="col-md-8">
                    <div class="form-group">
                        <label class="font-weight-bold" for="respondent_fname">Respondent Name:</label>
                        <input type="text" class="form-control" id="respondent_fname" name="respondent_fname" value="<?php echo htmlspecialchars($blotter['respondent_fname'] . ' ' . $blotter['respondent_mname'] . ' ' . $blotter['respondent_lname'] . ' ' . $blotter['respondent_suffix']);?>" disabled>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="font-weight-bold" for="respondent_contact">Respondent Contact #:</label>
                        <input type="text" class="form-control" id="respondent_contact" name="respondent_contact" value="<?php echo htmlspecialchars($blotter['respondent_contact']);?>" disabled>
                    </div>
                </div>    
        </div> 


        <div class="row">   
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="font-weight-bold" for="blotter_type">Blotter Type:</label>
                        <input type="text" class="form-control" id="blotter_type" name="blotter_type" value="<?php echo htmlspecialchars($blotter['blotter_type'] . ' ' . $blotter['respondent_mname'] . ' ' . $blotter['respondent_lname'] . ' ' . $blotter['respondent_suffix']);?>" disabled>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label class="font-weight-bold" for="details">Description/Report(s):</label>
                        <!-- <input type="text" class="form-control" id="details" name="details" value="<?php echo htmlspecialchars($blotter['details']);?>" disabled> -->
                        <textarea class="form-control" disabled> <?php echo htmlspecialchars($blotter['details']);?> </textarea>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="font-weight-bold" for="status">Status:</label>
                        <input type="text" class="form-control" id="status" name="status" value="<?php echo htmlspecialchars($blotter['status']);?>" disabled>
                    </div>
                </div>    
        </div>
        


    </div>


    




<script>

    $('#header_name_exchangeable').text('Blotter Information'); // Change text description


</script>

<?php

include("../includes/footer.php");


?>