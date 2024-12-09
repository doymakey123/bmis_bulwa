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
        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#userModal">Add User Account</button>


        <table class="table table-bordered mb-4" id="userTable" style="width: 100%">
            <thead>
                <tr>
                    <th>Seq. #</th>
                    <th>Email</th>
                    <th>Username #</th>
                    <th>Role</th>
                    <th>Date Created</th>
                    <th style="width:142px;">Actions</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

    </div>


<!-- Modal -->
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <form id="addUserForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">Add User Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editIdUser">
                    <br>
                    
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="first_pwd">Password</label>
                                <input type="password" class="form-control" id="first_pwd" name="first_pwd" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="second_pwd">Confirm Password</label>
                                <input type="password" class="form-control" id="second_pwd" name="second_pwd" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="showpassword">
                                <label class="custom-control-label" for="showpassword">Show Passowrd</label>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select class="custom-select" id="role" name="role" required>
                                    <option value="">Select Option</option>
                                    <option value="user">user</option>
                                    <option value="admin" disabled>admin</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn_addUpdateUser">Add</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="userpassModal" tabindex="-1" role="dialog" aria-labelledby="userpassModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <form id="updateUserpassForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="userpassModalLabel">Update User Account Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editIdUserpass">
                    <br>
                    
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="current_password">Current Password</label>
                                <input type="password" class="form-control" id="current_password" name="current_password" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="first_pwd_update">New Password</label>
                                <input type="password" class="form-control" id="first_pwd_update" name="first_pwd_update" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="second_pwd_update">Confirm New Password</label>
                                <input type="password" class="form-control" id="second_pwd_update" name="second_pwd_update" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="showpasswordupdate">
                                <label class="custom-control-label" for="showpasswordupdate">Show Passowrd</label>
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn_UpdateUserPassword">Upate</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>




<script>

    $('#header_name_exchangeable').text('User Account Information'); // Change text description

    $(document).ready( function () {
        $('#notActiveSkTable').DataTable({
            dom: '<"row"<"col-sm-12 col-md-6"f><"col-sm-12 col-md-6 text-right"l>>' +
             '<"row"<"col-sm-12"tr>>' +
             '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
        });
    } );


    const showPasswordCheckbox = document.getElementById('showpassword');
    const passwordInput = document.getElementById('first_pwd');
    const passwordInput2 = document.getElementById('second_pwd');

    showPasswordCheckbox.addEventListener('change', () => {
        if (showPasswordCheckbox.checked) {
            passwordInput.type = 'text';
            passwordInput2.type = 'text';
        } else {
            passwordInput.type = 'password';
            passwordInput2.type = 'password';
        }
    });


    const showPasswordCheckboxupdate = document.getElementById('showpasswordupdate');
    const passwordInputupdate = document.getElementById('first_pwd_update');
    const passwordInputupdate2 = document.getElementById('second_pwd_update');
    const passwordInputupdate3 = document.getElementById('current_password');

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