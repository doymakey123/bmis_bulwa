<?php

use PHPMailer\PHPMailer\PHPMailer;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

class ForgotPassword
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function sendOTP($email)
    {
        $stmt = $this->conn->prepare("SELECT email FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->rowCount() === 0) {
            return "Email not found.";
        }

        // Generate OTP and expiration time
        $otp = rand(100000, 999999);
        $expires_at = date('Y-m-d H:i:s', strtotime('+10 minutes'));

        // Insert OTP into the database
        $stmt = $this->conn->prepare("INSERT INTO password_resets (email, otp_code, expires_at) VALUES (?, ?, ?)");
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

    // public function verifyOTP($email, $otp)
    // {
    //     $stmt = $this->conn->prepare("SELECT * FROM password_resets WHERE email = ? AND otp_code = ? AND is_used = 0 AND expires_at > NOW()");
    //     $stmt->execute([$email, $otp]);

    //     if ($stmt->rowCount() === 0) {
    //         return "Invalid or expired OTP.";
    //     }

    //     $this->conn->prepare("UPDATE password_resets SET is_used = 1 WHERE email = ? AND otp_code = ?")->execute([$email, $otp]);
    //     return true;
    // }

    public function verifyOTP($email, $otp)
{
    $stmt = $this->conn->prepare("SELECT * FROM password_resets WHERE email = ? AND otp_code = ? LIMIT 1");
    $stmt->execute([$email, $otp]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$data) {
        return "No matching OTP found for the email.";
    }

    if ($data['is_used'] == 1) {
        return "This OTP has already been used.";
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
}
?>