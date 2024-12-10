<?php

session_start();

// Import PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer files using the correct relative path from the views directory
require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

// Database connection
$mysqli = new mysqli('localhost', 'root', '', 'db_bmis_bulwa');
if ($mysqli->connect_error) {
    die('Connection failed: ' . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize email input
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Invalid email format.';
        exit;
    }

    // Check if email exists in the database
    $stmt = $mysqli->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Email exists, generate OTP and send it via PHPMailer
        $otp = rand(100000, 999999);

        // Store OTP and expiration time in session
        $_SESSION['otp'] = $otp;
        $_SESSION['otp_expiration'] = time() + 600; // 10 minutes expiration
        $_SESSION['email'] = $email; // Store email in session for password reset

        // Send OTP email
        require 'PHPMailerAutoload.php';

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.yourmailserver.com'; // SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'dotwetpet@gmail.com';
        $mail->Password = 'your-email-password';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('dotwetpet@gmail.com', 'BMISbulwa');
        $mail->addAddress($email); // recipient email

        $mail->isHTML(true);
        $mail->Subject = 'Password Reset OTP';
        $mail->Body = 'Your OTP for password reset is: ' . $otp;

        if (!$mail->send()) {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'OTP has been sent to your email.';
            echo '<a href="verify_otp_view.php">Click here to enter OTP and reset password</a>';
        }
    } else {
        echo 'Email does not exist!';
    }

    $stmt->close();
    $mysqli->close();
}
?>
