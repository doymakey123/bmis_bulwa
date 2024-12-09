<?php


session_start();
if ($_SESSION['role'] !== 'admin') {
    header('Location: ../views/login.php');
    exit;
}

include("../includes/header.php");
include("../includes/navbar.php");
include("../includes/db.php");
include("../models/Brgyofficial.php");

$database = new Database();
$db = $database->connect();
$brgyNotActive = new Brgyofficial($db);
$brgyNotActive =  $brgyNotActive->fetchAllNotActive();
// echo json_encode($brgyNotActive);



?>


    <div class="container-fluid">

        <!-- Modal Trigger -->
        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#brgyModal">Add Brgy. Official</button>

        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="form-group">
                    <h3>Active Barangay Officials</h3>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>



        <table class="table table-bordered mb-4" id="brgyTable" style="width: 100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Complete Name</th>
                    <th>Position</th>
                    <th>Rank</th>
                    <th>Assign Area</th>
                    <th>Committee</th>
                    <th>Term</th>
                    <th>Year Elected</th>
                    <th>Status</th>
                    <th style="width:142px;">Actions</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

    </div>


    <div class="container-fluid mt-5" style="background-color: #f2f2f2;">

    <br><br>

        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="form-group">
                    <h3>Not Active Barangay Officials</h3>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>

              
        <table class="table table-bordered" id="notActiveBrgyTable" style="width: 100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Complete Name</th>
                    <th>Position</th>
                    <th>Rank</th>
                    <th>Assign Area</th>
                    <th>Committee</th>
                    <th>Term</th>
                    <th>Year Elected</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                     <?php
                        foreach($brgyNotActive as $brgynotactive){
                            $counter = 1;
                    ?>
                        <tr>
                            <td> <?php echo $counter++; ?> </td>
                            <td> <?php echo $brgynotactive['fname'] . ' ' . $brgynotactive['mname'] . ' '. $brgynotactive['lname'] . ' ' . $brgynotactive['suffix']; ?> </td>
                            <td> <?php echo $brgynotactive['position']; ?> </td>
                            <td> <?php echo $brgynotactive['rank']; ?> </td>
                            <td> <?php echo $brgynotactive['assign_area']; ?> </td>
                            <td> <?php echo $brgynotactive['committee']; ?> </td>
                            <td> <?php echo $brgynotactive['term']; ?> </td>
                            <td> <?php echo $brgynotactive['year_elected']; ?> </td>
                            <td> <?php echo $brgynotactive['status']; ?> </td>
                        </tr>
                    <?php
                        }
                    ?>
            </tbody>
        </table>

    </div>


<!-- Modal -->
<div class="modal fade" id="brgyModal" tabindex="-1" role="dialog" aria-labelledby="brgyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="addBrgyForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="brgyModalLabel">Add Barangay Official</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editIdBrgy">
                    <br>
                    
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="fname">First Name</label>
                                <input type="text" class="form-control" id="fname" name="fname" style="text-transform: capitalize;" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="mname">Middle Name</label>
                                <input type="text" class="form-control" id="mname" name="mname" style="text-transform: capitalize;">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="lname">Last Name</label>
                                <input type="text" class="form-control" id="lname" name="lname" style="text-transform: capitalize;" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="suffix">Suffix Name</label>
                                <input type="text" class="form-control" id="suffix" name="suffix" style="text-transform: capitalize;">
                            </div>
                        </div>
                    </div>
                    

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="position">Position</label>
                                <select class="custom-select" id="position" name="position" required>
                                    <option value="">Select Option</option>
                                    <option value="Captain">Captain</option>
                                    <option value="Kagawad">Kagawad</option>
                                    <option value="Secretary">Secretary</option>
                                    <option value="Treasurer">Treasurer</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="rank">Rank</label>
                                <select class="custom-select" id="rank" name="rank" required>
                                    <option value="">Select Option</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="assign_area">Assign Area</label>
                                <input type="text" class="form-control" id="assign_area" name="assign_area" style="text-transform: capitalize;" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="committee">Committee</label>
                                <input type="text" class="form-control" id="committee" name="committee" style="text-transform: capitalize;">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="term">Term</label>
                                <select class="custom-select" id="term" name="term" required>
                                    <option value="">Select Option</option>
                                    <option value="1st">1st</option>
                                    <option value="2nd">2nd</option>
                                    <option value="3rd">3rd</option>
                                    <option value="4th">4th</option>
                                    <option value="5th">5th</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="year_elected">Year Elected</label>
                                <input type="text" class="form-control" id="year_elected" name="year_elected" style="text-transform: capitalize;">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="custom-select" id="status" name="status" required>
                                    <option value="">Select Option</option>
                                    <option value="Active">Active</option>
                                    <option value="Not Active">Not Active</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                    </div> 
                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn_addUpdateBrgy">Add</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>




<script>

    $('#header_name_exchangeable').text('Barangay Official Information'); // Change text description

    $(document).ready( function () {
        $('#notActiveSkTable').DataTable({
            dom: '<"row"<"col-sm-12 col-md-6"f><"col-sm-12 col-md-6 text-right"l>>' +
             '<"row"<"col-sm-12"tr>>' +
             '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
        });
    } );

</script>
<?php

include("../includes/footer.php");


?>