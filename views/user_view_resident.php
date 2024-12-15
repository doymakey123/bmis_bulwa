<?php
session_start();
// if ($_SESSION['role'] !== 'user') {
//     header('Location: login.php');
//     exit;
// }

include("../includes/header.php");
include("../includes/navuser.php");
include("../ajax/individual_resident.php");
include("../ajax/fetch_household_member.php");



$id = filter_input(INPUT_GET,'id', FILTER_SANITIZE_NUMBER_INT);


// Call the individual method
$resident = $resident->individual($id);

echo '<script> var userRole = "' . ($_SESSION['role'] ?? '') . '" </script>';

?>




        <div class="container-fluid">

            <div class="row">
                <div class="col-md-2">
                    <!-- Current Image Display -->
    <div class="form-group">
        <label>Profile Picture:</label>
        <div id="imagePreview" style="border: 1px solid #ccc; padding: 10px; width: 200px; height: 200px; display: flex; justify-content: center; align-items: center;">
            <?php if (!empty($resident['image_path'])): ?>
                <img src="../<?php echo htmlspecialchars($resident['image_path']); ?>" alt="Resident Image" style="max-width: 100%; max-height: 100%;">
            <?php else: ?>
                <p>No image available.</p>
            <?php endif; ?>
        </div>
    </div>
                    
                </div>
                <div class="col-md-3">
                    
                </div>
                <div class="col-md-3">
                    
                </div>
                <div class="col-md-4 text-right">

                    <!-- Image Preview (Optional) -->
                    <div class="form-group">
                        <!-- <label>Image Preview:</label> -->
                        <div id="imagePreview" style="border: 1px solid #ccc; padding: 10px; width: 200px; height: 200px; display: flex; justify-content: center; align-items: center;">
                            <img id="previewImg" src="" alt="Preview" style="max-width: 100%; max-height: 100%; display: none;">
                        </div>
                    </div>

                    <form id="uploadImage" action="../ajax/add_image_resident.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($resident['id']);?>">
                        
                        <!-- Image Upload Section -->
                        <div class="form-group">
                            <label for="residentImage">Upload Resident Picture and display preview:</label>
                            <input type="file" id="residentImage" name="residentImage" class="form-control" accept="image/*">
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Upload Picture</button>
                    </form>
                </div>
            </div>  
            <br><br>

            <div class="row">
             
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="font-weight-bold" for="household_number">Household Number:</label>
                        <input type="text" class="form-control" id="household_number" name="household_number" value="<?php echo htmlspecialchars($resident['household_number']);?>" disabled>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="font-weight-bold" for="fname">First Name:</label>
                        <input type="text" class="form-control" id="fname" name="fname" value="<?php echo htmlspecialchars($resident['fname']);?>" disabled>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="font-weight-bold" for="mname">Middle Name:</label>
                        <input type="text" class="form-control" id="mname" name="mname" value="<?php echo htmlspecialchars($resident['mname']);?>" disabled>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="font-weight-bold" for="lname">Last Name:</label>
                        <input type="text" class="form-control" id="lname" name="lname" value="<?php echo htmlspecialchars($resident['lname']);?>" disabled>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label class="font-weight-bold" for="suffix">Sufix:</label>
                        <input type="text" class="form-control" id="suffix" name="suffix" value="<?php echo htmlspecialchars($resident['suffix']);?>" disabled>
                    </div>
                </div>
                <div class="col-md-1"> </div> 
            </div>  

            <div class="row">
                   
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="font-weight-bold" for="gender">Gender:</label>
                        <input type="text" class="form-control" id="gender" name="gender" value="<?php echo htmlspecialchars($resident['gender']);?>" disabled>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="font-weight-bold" for="dob">Birthday:</label>
                        <input type="text" class="form-control" id="dob" name="dob" value="<?php echo htmlspecialchars($resident['dob']);?>" disabled>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="font-weight-bold" for="civil_status">Civil Status:</label>
                        <input type="text" class="form-control" id="civil_status" name="civil_status" value="<?php echo htmlspecialchars($resident['civil_status']);?>" disabled>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="font-weight-bold" for="nationality">Nationality:</label>
                        <input type="text" class="form-control" id="nationality" name="nationality" value="<?php echo htmlspecialchars($resident['nationality']);?>" disabled>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="font-weight-bold" for="religion">Religion:</label>
                        <input type="text" class="form-control" id="religion" name="religion" value="<?php echo htmlspecialchars($resident['religion']);?>" disabled>
                    </div>
                </div>
          
            </div>

            <div class="row">
                   
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="font-weight-bold" for="purok">Purok:</label>
                        <input type="text" class="form-control" id="purok" name="purok" value="<?php echo htmlspecialchars($resident['purok']);?>" disabled>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="font-weight-bold" for="address">Address:</label>
                        <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($resident['address']);?>" disabled>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="font-weight-bold" for="mobile">Mobile #:</label>
                        <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo htmlspecialchars($resident['mobile']);?>" disabled>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="font-weight-bold" for="email">Email:</label>
                        <input type="text" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($resident['email']);?>" disabled>
                    </div>
                </div>
                
            </div>  


            <div class="row">
                   
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="font-weight-bold" for="voter_status">Voter Status:</label>
                        <input type="text" class="form-control" id="voter_status" name="voter_status" value="<?php echo htmlspecialchars($resident['voter_status']);?>" disabled>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="font-weight-bold" for="precinct_number">Precinct Number:</label>
                        <input type="text" class="form-control" id="precinct_number" name="precinct_number" value="<?php echo htmlspecialchars($resident['precinct_number']);?>" disabled>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="font-weight-bold" for="philhealth_number">Philhealth #:</label>
                        <input type="text" class="form-control" id="philhealth_number" name="philhealth_number" value="<?php echo htmlspecialchars($resident['philhealth_number']);?>" disabled>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="font-weight-bold" for="sss_gsis_number">SSS #:</label>
                        <input type="text" class="form-control" id="sss_gsis_number" name="email" value="<?php echo htmlspecialchars($resident['sss_gsis_number']);?>" disabled>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="font-weight-bold" for="tin_number">TIN #:</label>
                        <input type="text" class="form-control" id="tin_number" name="tin_number" value="<?php echo htmlspecialchars($resident['tin_number']);?>" disabled>
                    </div>
                </div>
                
            </div>

            <div class="row">
                   
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="font-weight-bold" for="educational_attainment">Educational Attainment:</label>
                        <input type="text" class="form-control" id="educational_attainment" name="educational_attainment" value="<?php echo htmlspecialchars($resident['educational_attainment']);?>" disabled>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="font-weight-bold" for="employment_status">Employment Status:</label>
                        <input type="text" class="form-control" id="employment_status" name="employment_status" value="<?php echo htmlspecialchars($resident['employment_status']);?>" disabled>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="font-weight-bold" for="occupation">Occupation:</label>
                        <input type="text" class="form-control" id="occupation" name="occupation" value="<?php echo htmlspecialchars($resident['occupation']);?>" disabled>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="font-weight-bold" for="monthly_annual_income">Monthly Income:</label>
                        <input type="text" class="form-control" id="monthly_annual_income" name="monthly_annual_income" value="<?php echo htmlspecialchars($resident['monthly_annual_income']);?>" disabled>
                    </div>
                </div>
                
            </div>  


            <div class="row">
                   
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="font-weight-bold" for="pwd_status">PWD Status:</label>
                        <input type="text" class="form-control" id="pwd_status" name="pwd_status" value="<?php echo htmlspecialchars($resident['pwd_status']);?>" disabled>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="font-weight-bold" for="solo_parent_status">Solo Parent Status:</label>
                        <input type="text" class="form-control" id="solo_parent_status" name="solo_parent_status" value="<?php echo htmlspecialchars($resident['solo_parent_status']);?>" disabled>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="font-weight-bold" for="relationship_household_head">Household Head Relationship:</label>
                        <input type="text" class="form-control" id="relationship_household_head" name="relationship_household_head" value="<?php echo htmlspecialchars($resident['relationship_household_head']);?>" disabled>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="font-weight-bold" for="head_of_the_family">Head of the Family:</label>
                        <input type="text" class="form-control" id="head_of_the_family" name="head_of_the_family" value="<?php echo htmlspecialchars($resident['head_of_the_family']);?>" disabled>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="font-weight-bold" for="type_of_dwelling">Type of Dwelling:</label>
                        <input type="text" class="form-control" id="type_of_dwelling" name="type_of_dwelling" value="<?php echo htmlspecialchars($resident['type_of_dwelling']);?>" disabled>
                    </div>
                </div>
                
            </div> 
            
            <div class="row">
                   
                   <div class="col-md-5">
                       <div class="form-group">
                           <label class="font-weight-bold" for="health_condition">Health Condition(s):</label>
                           <input type="text" class="form-control" id="health_condition" name="health_condition" value="<?php echo htmlspecialchars($resident['health_condition']);?>" disabled>
                       </div>
                   </div>
                   <div class="col-md-2">
                       <div class="form-group">
                           <label class="font-weight-bold" for="vaccination_status">Vaccination Status:</label>
                           <input type="text" class="form-control" id="vaccination_status" name="vaccination_status" value="<?php echo htmlspecialchars($resident['vaccination_status']);?>" disabled>
                       </div>
                   </div>
                   <div class="col-md-2">
                       <div class="form-group">
                           <label class="font-weight-bold" for="blood_type">Blood Type:</label>
                           <input type="text" class="form-control" id="blood_type" name="blood_type" value="<?php echo htmlspecialchars($resident['blood_type']);?>" disabled>
                       </div>
                   </div>
                   <div class="col-md-3">
                       <div class="form-group">
                           <label class="font-weight-bold" for="beneficiary_program">Beneficiary Program:</label>
                           <input type="text" class="form-control" id="beneficiary_program" name="beneficiary_program" value="<?php echo htmlspecialchars($resident['beneficiary_program']);?>" disabled>
                       </div>
                   </div>
                   
               </div>
               <br><br>

               <hr style="height:2px;border-width:0;color:gray;background-color:gray">

               
               <div class="row">
                        
                    <div class="col">
                        <div class="form-group">
                            <h3>Emergency Contact Information</h3>
                        </div>
                    </div>
               </div>

               <br>

               <div class="row">
                   
                   <div class="col-md-6">
                       <div class="form-group">
                           <label class="font-weight-bold" for="emergency_contact_person">Emergncy Contact Person:</label>
                           <input type="text" class="form-control" id="emergency_contact_person" name="emergency_contact_person" value="<?php echo htmlspecialchars($resident['emergency_contact_person']);?>" disabled>
                       </div>
                   </div>
                   <div class="col-md-3">
                       <div class="form-group">
                           <label class="font-weight-bold" for="emergency_contact_relationship">Relationship:</label>
                           <input type="text" class="form-control" id="emergency_contact_relationship" name="emergency_contact_relationship" value="<?php echo htmlspecialchars($resident['emergency_contact_relationship']);?>" disabled>
                       </div>
                   </div>
                   <div class="col-md-3">
                       <div class="form-group">
                           <label class="font-weight-bold" for="emergency_contact_number">Contact #:</label>
                           <input type="text" class="form-control" id="emergency_contact_number" name="emergency_contact_number" value="<?php echo htmlspecialchars($resident['emergency_contact_number']);?>" disabled>
                       </div>
                   </div>
                        
               </div> 
               <br><br>

        </div>


        <div class="container-fluid" style="background-color: #f2f2f2; text-align:center;">

        <br><br>

                <?php

                    $id1 = $resident['id'];
                    $household_number = $resident['household_number'];
                    $household_members =  $resident_household->householdMember($id1, $household_number);

               ?>
               

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <h3>Household Member(s)</h3>
                    </div>
                </div>
            </div>

            <table class="table table-bordered" id="residentHouseholdMemberTable" style="width: 100%">
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
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($household_members as $member){
                            $counter = 1;
                    ?>
                        <tr>
                            <td> <?php echo $counter++; ?> </td>
                            <td> <?php echo $member['household_number']; ?> </td>
                            <td> <?php echo $member['fname'] . ' ' . $member['mname'] . ' '. $member['lname'] . ' ' . $member['suffix']; ?> </td>
                            <td> <?php echo $member['age']; ?> </td>
                            <td> <?php echo $member['dob']; ?> </td>
                            <td> <?php echo $member['purok']; ?> </td>
                            <td> <?php echo $member['voter_status']; ?> </td>
                            <td> <?php echo $member['employment_status']; ?> </td>
                        </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>


        </div>



       



<script>

    $('#header_name_exchangeable').text('Personal Resident Information'); // Change text description

    document.getElementById('residentImage').addEventListener('change', function (event) {
    const file = event.target.files[0];
    const previewImg = document.getElementById('previewImg');

    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            previewImg.src = e.target.result;
            previewImg.style.display = 'block'; // Show the image
        };
        reader.readAsDataURL(file);
    } else {
        previewImg.src = '';
        previewImg.style.display = 'none'; // Hide the image if no file is selected
    }
});



</script>


<?php

include("../includes/footer.php");


?>