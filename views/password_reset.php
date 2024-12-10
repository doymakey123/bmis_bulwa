<?php
session_start();

// Database connection
$mysqli = new mysqli('localhost', 'root', '', 'db_bmis_bulwa');
if ($mysqli->connect_error) {
    die('Connection failed: ' . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['new_password'])) {
    // Sanitize new password input
    $new_password = trim($_POST['new_password']);

    // Validate password: minimum 8 characters, alphanumeric, and special characters
    if (strlen($new_password) < 8) {
        echo 'Password must be at least 8 characters long.';
        exit;
    }

    if (!preg_match('/[A-Za-z]/', $new_password)) {
        echo 'Password must contain at least one letter.';
        exit;
    }

    if (!preg_match('/\d/', $new_password)) {
        echo 'Password must contain at least one number.';
        exit;
    }

    if (!preg_match('/[\W_]/', $new_password)) {
        echo 'Password must contain at least one special character.';
        exit;
    }

    // Hash the new password
    $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

    // Update password in the database
    $stmt = $mysqli->prepare("UPDATE users SET password = ? WHERE email = ?");
    $stmt->bind_param('ss', $hashed_password, $_SESSION['email']);
    
    if ($stmt->execute()) {
        echo 'Your password has been successfully reset!';
        // Clear session
        unset($_SESSION['otp']);
        unset($_SESSION['otp_expiration']);
        unset($_SESSION['email']);
    } else {
        echo 'Error resetting password!';
    }

    $stmt->close();
    $mysqli->close();
}
?>
