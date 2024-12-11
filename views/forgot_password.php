<?php
// Include database and ForgotPassword class
require '../includes/db.php';
require '../models/ForgotPassword.php';
session_start(); // Start the session to store the user's email

// Initialize database connection
$database = new Database();
$pdo = $database->connect();

// Use the connection for ForgotPassword
$forgotPassword = new ForgotPassword($pdo);
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message = $forgotPassword->sendOTP($email);

    if ($message === "OTP sent to your email.") {
        $_SESSION['email'] = $email; // Store email in session for the reset password page
        header('Location: reset_password.php'); // Redirect to the reset password page
        exit(); // Stop further execution
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
</head>
<body>
    <h1>Forgot Password</h1>
    <form action="" method="POST">
        <label for="email">Enter your email:</label>
        <input type="email" name="email" id="email" required>
        <button type="submit">Send OTP</button>
    </form>
    <p><?php echo htmlspecialchars($message); ?></p>
</body>
</html>
