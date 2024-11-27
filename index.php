<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['role'])) {
    // Redirect to the respective role's dashboard
    switch ($_SESSION['role']) {
        case 'admin':
            header('Location: views/admin.php');
            break;
        case 'user':
            header('Location: views/user.php');
            break;
        default:
            // If the role is not recognized, destroy the session and redirect to login
            session_destroy();
            header('Location: views/login.php');
    }
    exit;
} else {
    // If not logged in, redirect to login page
    header('Location: views/login.php');
    exit;
}
