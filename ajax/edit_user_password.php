<?php

session_start();
require_once '../includes/db.php';
require_once '../models/User.php';

$database = new Database();
$db = $database->connect();
$user = new User($db);

if(isset($_POST['btn_edit_user_password'])) {


    $id = intval(htmlspecialchars(strip_tags($_POST['edit_user_password_id'])));

    $current_password = htmlspecialchars(strip_tags($_POST['current_password']));
    $new_password = htmlspecialchars(strip_tags($_POST['new_password']));
    $confirm_password = htmlspecialchars(strip_tags($_POST['confirm_password']));


    // Check if current password matches
    if ($user->checkCurrentPassword($id, $current_password)) {

            if(($new_password === $confirm_password) && $new_password != '' && $confirm_password != ''){

                // Hash the new password
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                // Update password in database
                if ($user->updatePassword($id, $hashed_password)) {
                    $_SESSION['successMessage'] = "Password updated successfully.";
                    header('Location: ../views/setting.php');
                    die();
                } else {
                    $_SESSION['failedMessage'] = "New and confirm password not matched.";
                    header('Location: ../views/setting.php');
                    die();
                }
        }else{
            $_SESSION['failedMessage'] = "Failed to updated password.";
                header('Location: ../views/setting.php');
                die();
        }
    } else {
        $_SESSION['failedMessage'] = "Current password is incorrect.";
                header('Location: ../views/setting.php');
                die();
        
    }
}
?>
