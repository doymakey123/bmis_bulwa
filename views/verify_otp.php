<?php

session_start();

// Database connection
$mysqli = new mysqli('localhost', 'root', '', 'db_bmis_bulwa');
if ($mysqli->connect_error) {
    die('Connection failed: ' . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize OTP input
    $entered_otp = filter_var(trim($_POST['otp']), FILTER_SANITIZE_NUMBER_INT);

    // Check if OTP is valid and not expired
    if (isset($_SESSION['otp']) && isset($_SESSION['otp_expiration'])) {
        if (time() < $_SESSION['otp_expiration']) {
            // OTP is valid
            if ($entered_otp == $_SESSION['otp']) {
                // OTP matches, allow password reset
                echo 'OTP is valid! Please enter your new password.';
                echo '<form method="POST" action="reset_password.php">
                        <input type="password" name="new_password" required placeholder="Enter new password">
                        <input type="submit" value="Reset Password">
                      </form>';
            } else {
                echo 'Invalid OTP!';
            }
        } else {
            echo 'OTP has expired!';
        }
    } else {
        echo 'No OTP found in session!';
    }
}
?>
