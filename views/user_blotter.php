<?php


session_start();
if ($_SESSION['role'] !== 'user') {
    header('Location: ../views/login.php');
    exit;
}

include("../includes/header.php");
include("../includes/navuser.php");

echo '<script> var userRole = "' . ($_SESSION['role'] ?? '') . '" </script>';


?>


    <div class="container-fluid">

        <!-- Modal Trigger -->
        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#blotterModal">Add Blotter</button>


        <table class="table table-bordered" id="blotterTable" style="width: 100%">
            <thead>
                <tr>
                    <th>Seq. #</th>
                    <th>Complainant Name</th>
                    <th>Respondent Name</th>
                    <th>Blotter Type</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th style="width:142px;">Actions</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

    </div>


<!-- Modal -->
<div class="modal fade" id="blotterModal" tabindex="-1" role="dialog" aria-labelledby="blotterModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="addBlotterForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="blotterModalLabel">Add Blotter</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editIdBlotter">

                    <div class="row">
                        <div class="col-md-4"> </div>
                        <div class="col-md-4"> 
                            <h5 class="modal-title" id="complainantInformation">Complainant Information</h5>
                        </div>
                        <div class="col-md-4"> </div>
                    </div>

                    <br>
                    
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="complainant_fname">First Name</label>
                                <input type="text" class="form-control" id="complainant_fname" name="complainant_fname" style="text-transform: capitalize;" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="complainant_mname">Middle Name</label>
                                <input type="text" class="form-control" id="complainant_mname" name="complainant_mname" style="text-transform: capitalize;">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="complainant_lname">Last Name</label>
                                <input type="text" class="form-control" id="complainant_lname" name="complainant_lname" style="text-transform: capitalize;" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="complainant_suffix">Suffix Name</label>
                                <input type="text" class="form-control" id="complainant_suffix" name="complainant_suffix" style="text-transform: capitalize;">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="complainant_address">Address</label>
                                <input type="text" class="form-control" id="complainant_address" name="complainant_address" style="text-transform: capitalize;" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="complainant_contact">Mobile Number</label>
                                <input type="text" class="form-control" id="complainant_contact" name="complainant_contact" style="text-transform: capitalize;" maxlength="11" placeholder="09XXXXXXXXX" required>
                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-md-4"> </div>
                        <div class="col-md-4"> 
                            <h5 class="modal-title" id="respondentInformation">Respondent Information</h5>
                        </div>
                        <div class="col-md-4"> </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="respondent_fname">First Name</label>
                                <input type="text" class="form-control" id="respondent_fname" name="respondent_fname" style="text-transform: capitalize;" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="respondent_mname">Middle Name</label>
                                <input type="text" class="form-control" id="respondent_mname" name="respondent_mname" style="text-transform: capitalize;">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="respondent_lname">Last Name</label>
                                <input type="text" class="form-control" id="respondent_lname" name="respondent_lname" style="text-transform: capitalize;" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="respondent_suffix">Suffix Name</label>
                                <input type="text" class="form-control" id="respondent_suffix" name="respondent_suffix" style="text-transform: capitalize;">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="respondent_contact">Mobile Number</label>
                                <input type="text" class="form-control" id="respondent_contact" name="respondent_contact" maxlength="11" placeholder="09XXXXXXXXX" style="text-transform: capitalize;">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="blotter_type">Blotter Type</label>
                                <select class="custom-select" id="blotter_type" name="blotter_type" required>
                                    <option value="">Select Option</option>
                                    <option value="Blotter">Blotter</option>
                                    <option value="Incident">Incident</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="details">Description</label>
                                <textarea class="form-control" name="details" id="details" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="status">Description</label>
                                <select class="custom-select" id="status" name="status" required>
                                    <option value="">Select Option</option>
                                    <option value="Active">Active</option>
                                    <option value="Settled">Settled</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    

                 
                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn_addUpdateBlotter">Add</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>




<script>

    $('#header_name_exchangeable').text('Blotter Information'); // Change text description

</script>
<?php

include("../includes/footer.php");


?>


<script>
    
    $(document).ajaxSuccess(function(){
        console.log(userRole);
        if(userRole !== 'admin') {
            $('.delete-btnblotter').hide();
        }
    });

</script>