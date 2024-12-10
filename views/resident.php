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

        <!-- Modal Trigger -->
        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#residentModal">Add Resident</button>

        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-3"></div>
            <div class="col-md-3"></div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="purokFilter">Purok Filter:</label>
                    <select id="purokFilter" class="form-control">
                        <option value="all">All</option>
                        <option value="1">Purok 1</option>
                        <option value="2">Purok 2</option>
                        <option value="3">Purok 3</option>
                        <option value="4">Purok 4</option>
                        <option value="5">Purok 5</option>
                        <option value="6">Purok 6</option>
                        <option value="7">Purok 7</option>
                        <option value="8">Purok 8</option>
                        <option value="9">Purok 9</option>
                        <option value="10">Purok 10</option>
                    </select>
                </div>
            </div>
        </div>


        <!-- datatable ajax default -->
        <table class="table table-bordered" id="residentTable" style="width: 100%">
            <thead>
                <tr>
                    <th>Seq. #</th>
                    <th>Household #</th>
                    <th>Full Name</th>
                    <th>Age</th>
                    <th>Birthday</th>
                    <th>Purok</th>
                    <th>Voter Status</th>
                    <th>Employment Status</th>
                    <th style="width:142px;">Actions</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

    </div>


<!-- Modal -->
<div class="modal fade" id="residentModal" tabindex="-1" role="dialog" aria-labelledby="residentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="addResidentForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="residentModalLabel">Add Resident - Personal Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editId">

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="household_number">Household Number</label>
                                <input type="text" class="form-control" id="household_number" name="household_number" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            
                        </div>
                        <div class="col-md-3">
                           
                        </div>
                        <div class="col-md-3">
                            
                        </div>
                    </div>
                    
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
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select class="custom-select" id="gender" name="gender" required>
                                    <option value="">Select Option</option>
                                    <option value="Female">Female</option>
                                    <option value="Male">Male</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="dob">Date of Birth</label>
                                <input type="date" class="form-control" id="dob" name="dob" max="<?= date('Y-m-d'); ?>" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="civil_status">Civil Status</label>
                                <select class="custom-select" id="civil_status" name="civil_status" required>
                                    <option value="">Select Option</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Separated or Divorced">Separated or Divorced</option>
                                    <option value="Widowed">Widowed</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nationality">Nationality</label>
                                <input type="text" class="form-control" id="nationality" name="nationality" style="text-transform: capitalize;" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="religion">Religion</label>
                                <input type="text" class="form-control" id="religion" name="religion" style="text-transform: capitalize;" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="purok">Purok</label>
                                <select class="custom-select" id="purok" name="purok" required>
                                    <option value="">Select Option</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="address">Current Address</label>
                                <input type="text" class="form-control" id="address" name="address" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="mobile">Mobile Number</label>
                                <input type="tel" class="form-control" id="mobile" name="mobile" maxlength="11" placeholder="09XXXXXXXXX" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" autocomplete="off" placeholder="sample@gmail.com" style="text-transform: lowercase;" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="voter_status">Voter Status</label>
                                <select class="custom-select" id="voter_status" name="voter_status" onchange="checkInputVoter(this)" required>
                                    <option value="">Select Option</option>
                                    <option value="Registered">Registered</option>
                                    <option value="Not Registered">Not Registered</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group" id="div_precinct_number" style="display:none;">
                            <label for="precinct_number">Precinct Number</label>
                            <input type="text" class="form-control" id="precinct_number" name="precinct_number" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label for="philhealth_number">Philhealth Number</label>
                            <input type="text" class="form-control" id="philhealth_number" name="philhealth_number" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="sss_gsis_number">SSS/GSIS Number</label>
                                <input type="text" class="form-control" id="sss_gsis_number" name="sss_gsis_number">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tin_number">TIN Number</label>
                                <input type="text" class="form-control" id="tin_number" name="tin_number">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="educational_attainment">Educational Attainment</label>
                                <select class="custom-select" id="educational_attainment" name="educational_attainment" required>
                                    <option value="">Select Option</option>
                                    <option value="No Formal Education">No Formal Education</option>
                                    <option value="Elementary">Elementary</option>
                                    <option value="High School">High School</option>
                                    <option value="Vocational">Vocational</option>
                                    <option value="College Level">College Level</option>
                                    <option value="College Graduate">College Graduate</option>
                                    <option value="Postgraduate">Postgraduate</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="employment_status">Employment Status</label>
                                <select class="custom-select" id="employment_status" name="employment_status" onchange="checkInputEmployment(this)" required>
                                    <option value="">Select Option</option>
                                    <option value="Employed">Employed</option>
                                    <option value="Unemployed">Unemployed</option>
                                    <option value="Retired">Retired</option>
                                    <option value="Student">Student</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group" id="div_occupation" style="display:none;">
                                <label for="occupation">Occupation</label>
                                <input type="text" class="form-control" id="occupation" name="occupation" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="monthly_annual_income">Monthly/Annual Income</label>
                                <input type="text" class="form-control" id="monthly_annual_income" name="monthly_annual_income" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="pwd_status">PWD Status</label>
                                <select class="custom-select" id="pwd_status" name="pwd_status" required>
                                    <option value="">Select Option</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label for="solo_parent_status">Solo Parent</label>
                                <select class="custom-select" id="solo_parent_status" name="solo_parent_status" required>
                                    <option value="">Select Option</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                            <label for="relationship_household_head">Relationship to Household Head</label>
                                <select class="custom-select" id="relationship_household_head" name="relationship_household_head" onchange="checkInputHeadFamily(this)" required>
                                    <option value="">Select Option</option>
                                    <option value="Head">Head</option>
                                    <option value="Spouse">Spouse</option>
                                    <option value="Child">Child</option>
                                    <option value="Parent">Parent</option>
                                    <option value="Relative">Relative</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group" id="div_head_of_the_family" style="display:none;">
                                <label for="head_of_the_family">Name Head Family</label>
                                <input type="text" class="form-control" id="head_of_the_family" name="head_of_the_family" >
                                <div id="search_results_head"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="type_of_dwelling">Type of Dwelling</label>
                                <select class="custom-select" id="type_of_dwelling" name="type_of_dwelling" required>
                                    <option value="">Select Option</option>
                                    <option value="Owned">Owned</option>
                                    <option value="Rented">Rented</option>
                                    <option value="Government Housing">Government Housing</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="health_condition">Health Condition(s)</label>
                                <input type="text" class="form-control" id="health_condition" name="health_condition" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="vaccination_status">Vaccination Status</label>
                                <select class="custom-select" id="vaccination_status" name="vaccination_status" required>
                                    <option value="">Select Option</option>
                                    <option value="Fully Vaccinated">Fully Vaccinated</option>
                                    <option value="Partially Vaccinated">Partially Vaccinated</option>
                                    <option value="Not Vaccinated">Not Vaccinated</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="blood_type">Blood Type</label>
                                <select class="custom-select" id="blood_type" name="blood_type" required>
                                    <option value="">Select Option</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="blood_type">Beneficiary Program</label>
                                <select class="custom-select" id="beneficiary_program" name="beneficiary_program" required>
                                    <option value="">Select Option</option>
                                    <option value="4Ps">4Ps</option>
                                    <option value="Senior Citizen Pension">Senior Citizen Pension</option>
                                    <option value="Scholarship">Scholarship</option>
                                    <option value="Livelihood Assistance">Livelihood Assistance</option>
                                    <option value="Calamity Assistance">Calamity Assistance</option>
                                    <option value="PWD Assistance">PWD Assistance</option>
                                    <option value="Solo Parent Assistance">Solo Parent Assistance</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="modal-header">
                        </div>
                            <h5 class="modal-title" id="emergencyContactInformationModalLabel">Emergency Contact Information </h5>
                        <div class="modal-header">
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="emergency_contact_person">Full Name</label>
                                <input type="text" class="form-control" id="emergency_contact_person" name="emergency_contact_person" style="text-transform: capitalize;" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="emergency_contact_relationship">Relationship</label>
                                <select class="custom-select" id="emergency_contact_relationship" name="emergency_contact_relationship" required>
                                    <option value="">Select Option</option>
                                    <option value="Head">Head</option>
                                    <option value="Spouse">Spouse</option>
                                    <option value="Child">Child</option>
                                    <option value="Parent">Parent</option>
                                    <option value="Relative">Relative</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="emergency_contact_number">Contact Number</label>
                                <input type="text" class="form-control" id="emergency_contact_number" name="emergency_contact_number" style="text-transform: capitalize;" required>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn_addUpdate">Add</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>


    function checkInputVoter(select) {
        if (select.value === "Registered") {
            document.getElementById("div_precinct_number").style.display = "inline";
        } else {
            document.getElementById("div_precinct_number").style.display = "none";
        }
    }

    function checkInputEmployment(select) {
        if (select.value === "Employed") {
            document.getElementById("div_occupation").style.display = "inline";
        } else {
            document.getElementById("div_occupation").style.display = "none";
        }
    }


    function checkInputHeadFamily(select) {
        if (select.value === "Spouse" || select.value === "Child" || select.value === "Parent" || select.value === "Relative" || select.value === "Other") {
            document.getElementById("div_head_of_the_family").style.display = "inline";
        } else {
            document.getElementById("div_head_of_the_family").style.display = "none";
        }
    }



    $(document).ready(function() {
        
        $('#head_of_the_family').keyup(function() {
            var head_of_the_family = $(this).val();
            $.ajax({
                type: 'POST',
                url: '../ajax/fetch_searchmodal.php',
                data: {head_of_the_family: head_of_the_family},
                success: function(data) {
                    $('#search_results_head').html(data);
                }
            });

        });

    });

    $(document).on('click', '#search_results_head span', function() {
        var selectedValue = $(this).text();
        
        $('#head_of_the_family').val(selectedValue);
        $('#search_results_head').html('');

    });


    $('#head_of_the_family').on('input', function() {
    if ($(this).val().trim() === '') {
        $('#search_results_head').html('').hide();  // Clear content and hide the div
        console.log('Input is empty!');
    } else {
        $('#search_results_head').show();
        console.log('Input is not empty!');
    }
});
    




</script>



<?php

include("../includes/footer.php");

?>