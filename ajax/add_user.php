<?php
require_once '../includes/db.php';
require_once '../models/User.php';

$database = new Database();
$db = $database->connect();
$user = new User($db);



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $username = htmlspecialchars(strip_tags($_POST['username']));
    $password1 = htmlspecialchars(strip_tags($_POST['first_pwd']));
    $password2 = htmlspecialchars(strip_tags($_POST['second_pwd']));
    $role = htmlspecialchars(strip_tags($_POST['role']));

    $password = '';

    // Check if user accountt already exists
    if ($user->exists($email)) {
        echo json_encode(['success' => false, 'message' => 'Email data already exists.']);

    }else if ($user->existsu($username)) {
        echo json_encode(['success' => false, 'message' => 'Username data already exists.']);

    }else {

            $password = password_hash($password1, PASSWORD_DEFAULT);

            // Add new user account
            $result = $user->create($email, $username, $password, $role);
            echo json_encode($result);
        
    }



}
?>
