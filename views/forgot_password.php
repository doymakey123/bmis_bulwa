<?php
// Include database and ForgotPassword class
require '../includes/db.php';
require '../models/ForgotPassword.php';
session_start(); // Start the session to store the user's email

date_default_timezone_set('Asia/Manila');


// Initialize database connection
$database = new Database();
$pdo = $database->connect();

// Use the connection for ForgotPassword
$forgotPassword = new ForgotPassword($pdo);
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message = $forgotPassword->sendOTP($email);

    // if ($message === "OTP sent to your email.") {
    //     $_SESSION['email'] = $email; // Store email in session for the reset password page
    //     header('Location: reset_password.php'); // Redirect to the reset password page
    //     exit(); // Stop further execution
    // }

    if ($message === "OTP sent to your email.") {
        $_SESSION['email'] = $email; // Store email in session
        header('Location: verify_otp.php'); // Redirect to OTP verification page
        exit();
    }

    
}
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="icon" href="../assets/img/bulwalogo.png" type="image/x-icon">
    <title>Forgot Password</title>
  </head>
  <body>
    
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <h3 style="text-align: center;">Forgot Password</h3>
            </div>
            <div class="col-md-4"></div>
        </div>
        <div class="row mt-5">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <?php if(isset($message) && $message != ''){ ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <?php  echo htmlspecialchars($message); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php } ?>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="email">Enter your email:</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                    <button type="submit" class="btn btn-primary float-md-right">Send OTP</button>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>


    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    
  </body>
</html>


