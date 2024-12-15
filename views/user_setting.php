<?php


session_start();
if ($_SESSION['role'] !== 'user') {
    header('Location: ../views/login.php');
    exit;
}

$id_user_password = '';

if (isset($_SESSION['id']) && $_SESSION['id'] != null ){

    $id_user_password = $_SESSION['id'];
   
}

include("../includes/header.php");
include("../includes/navuser.php");




?>


    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">

                <?php

                    if(isset($_SESSION['successMessage']) && $_SESSION['successMessage'] !=''){
                        $successmessage = $_SESSION['successMessage']
                ?>
            
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?php echo $successmessage; ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                <?php
                        unset($_SESSION['successMessage']);
                    }

                    if(isset($_SESSION['failedMessage']) && $_SESSION['failedMessage'] !=''){
                        $errormessage =  $_SESSION['failedMessage'] ;
                ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <?php echo $errormessage; ?>
                               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                <?php
                        unset($_SESSION['failedMessage']);
                    }

                ?>
            </div>
            <div class="col-md-4"></div>
        </div>

        <form id="changeUserPasswordForm" name="edit_user_password" action="../ajax/edit_user_password.php" method="POST">
            <input type="hidden" name="edit_user_password_id" id="edit_user_password_id" value="<?php echo $id_user_password; ?>">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="current_password">Current Password</label>
                        <input type="password" class="form-control" id="current_password" name="current_password" required>
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="new_password">New Password</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="showpassword">
                        <label class="custom-control-label" for="showpassword">Show Password</label>
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="form-group float-right">
                        <button type="submit" class="btn btn-primary" name="btn_edit_user_password" id="btn_UpdateUserPassword">Update</button>
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
        </form>
    </div>


<script>

    $('#header_name_exchangeable').text('Change Password'); // Change text description

    const showPasswordCheckboxupdate = document.getElementById('showpassword');
    const passwordInputupdate = document.getElementById('current_password');
    const passwordInputupdate2 = document.getElementById('new_password');
    const passwordInputupdate3 = document.getElementById('confirm_password');

    showPasswordCheckboxupdate.addEventListener('change', () => {
        if (showPasswordCheckboxupdate.checked) {
            passwordInputupdate.type = 'text';
            passwordInputupdate2.type = 'text';
            passwordInputupdate3.type = 'text';
        } else {
            passwordInputupdate.type = 'password';
            passwordInputupdate2.type = 'password';
            passwordInputupdate3.type = 'password';
        }
    });


</script>
<?php

include("../includes/footer.php");


?>