<?php
require_once '../includes/db.php';
require_once '../models/User.php';

$database = new Database();
$db = $database->connect();
$user = new User($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = intval($_POST['id']);
    $current_password = htmlspecialchars(strip_tags($_POST['current_password']));
    $new_password = htmlspecialchars(strip_tags($_POST['first_pwd_update']));
    $second_password = htmlspecialchars(strip_tags($_POST['second_pwd_update']));


    // Check if current password matches
    if ($user->checkCurrentPassword($id, $current_password)) {
        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update password in database
        if ($user->updatePassword($id, $hashed_password)) {
            echo json_encode(['success' => true, 'message' => 'Password updated successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update user password.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Current password is incorrect.']);
    }
}
?>
