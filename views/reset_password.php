<?php
require '../includes/db.php';
require '../models/ForgotPassword.php';
session_start(); // Start the session to access the stored email


// Ensure the email exists in the session
if (!isset($_SESSION['email'])) {
    header('Location: forgot_password.php'); // Redirect to forgot password if no email in session
    exit();
}

// Initialize database connection
$database = new Database();
$pdo = $database->connect();
$forgotPassword = new ForgotPassword($pdo);

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_SESSION['email']; // Get email from session
    $otp = filter_var($_POST['otp'], FILTER_SANITIZE_NUMBER_INT);
    $password = $_POST['password'];

    $otpVerification = $forgotPassword->verifyOTP($email, $otp);
    if ($otpVerification === true) {
        $message = $forgotPassword->resetPassword($email, $password);
        unset($_SESSION['email']); // Clear session after successful reset
        header('Location: login.php'); // Redirect to the reset password page
        exit(); // Stop further execution
    } else {
        $message = $otpVerification;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
</head>
<body>
    <h1>Reset Password</h1>
    <form action="" method="POST">
        <label for="otp">Enter OTP:</label>
        <input type="number" name="otp" id="otp" required>

        <label for="password">New Password:</label>
        <input type="password" name="password" id="password" required>
        <small>Password must include letters, numbers, and special characters.</small>

        <button type="submit">Reset Password</button>
    </form>
    <p><?php echo htmlspecialchars($message); ?></p>
</body>
</html>
