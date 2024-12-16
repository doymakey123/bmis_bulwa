<?php
require '../includes/db.php';
require '../models/ForgotPassword.php';
session_start();

date_default_timezone_set('Asia/Manila');


if (!isset($_SESSION['email'])) {
    header('Location: forgot_password.php');
    exit();
}

$database = new Database();
$pdo = $database->connect();
$forgotPassword = new ForgotPassword($pdo);

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_SESSION['email'];
    if (isset($_POST['otp'])) {
        $otp = filter_var($_POST['otp'], FILTER_SANITIZE_NUMBER_INT);
        $otpVerification = $forgotPassword->verifyOTP($email, $otp);

        if ($otpVerification === true) {
            header('Location: reset_password.php'); // Redirect to reset password page
            exit();
        } else {
            $message = $otpVerification;
        }
    } elseif (isset($_POST['resend'])) {
        $message = $forgotPassword->resendOTP($email);
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

    <title>Verify OTP</title>
    <link rel="icon" href="../assets/img/bulwalogo.png" type="image/x-icon">
  </head>
  <body>
    
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <h3 style="text-align: center;">Verify OTP</h3>
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
                        <label for="otp">Enter OTP:</label>
                        <input type="number" class="form-control" name="otp" id="otp" required>
                    </div>
                    <button type="submit" class="btn btn-primary float-md-right">Verify OTP</button>
                </form>
                <form action="" method="POST">
                    <button type="submit" class="btn btn-primary float-md-left" name="resend">Resend OTP</button>
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
