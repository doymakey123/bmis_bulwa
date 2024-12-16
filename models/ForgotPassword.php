<?php

use PHPMailer\PHPMailer\PHPMailer;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

date_default_timezone_set('Asia/Manila');

class ForgotPassword
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }


    public function sendOTP($email)
    {
        // Check if the email exists in the `users` table
        $stmt = $this->conn->prepare("SELECT email FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->rowCount() === 0) {
            return "Email not found.";
        }

        // Mark all previous OTPs for this email as used
        $stmt = $this->conn->prepare("UPDATE password_resets SET is_used = 1 WHERE email = ?");
        $stmt->execute([$email]);

        // Generate a new OTP and expiration time
        $otp = rand(100000, 999999);
        $expires_at = date('Y-m-d H:i:s', strtotime('+10 minutes'));

        // Insert the new OTP into the database
        $stmt = $this->conn->prepare("INSERT INTO password_resets (email, otp_code, expires_at, is_used) VALUES (?, ?, ?, 0)");
        $stmt->execute([$email, $otp, $expires_at]);

        // Send OTP via email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = '@gmail.com';
        $mail->Password = '';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('dotwetpet@gmail.com', 'BMIS BULWA');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Password Reset OTP';
        $mail->Body = "Your OTP is: <b>$otp</b>. It is valid for 10 minutes.";

        return $mail->send() ? "OTP sent to your email." : "Failed to send OTP.";
    }



    public function verifyOTP($email, $otp)
    {
        $stmt = $this->conn->prepare("SELECT * FROM password_resets WHERE email = ? AND otp_code = ? AND is_used = 0 LIMIT 1");
        $stmt->execute([$email, $otp]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return "No valid OTP request found for this email. Please request a new one.";
        }

        if (strtotime($data['expires_at']) < time()) {
            return "The OTP has expired.";
        }

        // Mark the OTP as used
        $this->conn->prepare("UPDATE password_resets SET is_used = 1 WHERE email = ? AND otp_code = ?")->execute([$email, $otp]);

        return true;
    }



    public function resetPassword($email, $password)
    {
        if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password)) {
            return "Password must be at least 8 characters long and include letters, numbers, and special characters.";
        }

        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $this->conn->prepare("UPDATE users SET password = ? WHERE email = ?")->execute([$hashed_password, $email]);
        return "Password reset successfully.";
    }


    public function resendOTP($email)
    {
        // Check if the email exists in the `users` table
        $stmt = $this->conn->prepare("SELECT email FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->rowCount() === 0) {
            return "Email not found.";
        }

        // Mark all previous OTPs for this email as used
        $stmt = $this->conn->prepare("UPDATE password_resets SET is_used = 1 WHERE email = ?");
        $stmt->execute([$email]);

        // Generate a new OTP and expiration time
        $otp = rand(100000, 999999);
        $expires_at = date('Y-m-d H:i:s', strtotime('+10 minutes'));

        // Insert the new OTP into the database
        $stmt = $this->conn->prepare("INSERT INTO password_resets (email, otp_code, expires_at, is_used) VALUES (?, ?, ?, 0)");
        $stmt->execute([$email, $otp, $expires_at]);

        // Send OTP via email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = '@gmail.com'; // Replace with your actual email
        $mail->Password = ''; // Replace with your actual email password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('dotwetpet@gmail.com', 'BMIS BULWA');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Resend Password Reset OTP';
        $mail->Body = "Your new OTP is: <b>$otp</b>. It is valid for 10 minutes.";

        return $mail->send() ? "New OTP sent to your email." : "Failed to send new OTP.";
    }


}
?>
