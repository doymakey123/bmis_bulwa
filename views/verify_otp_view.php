
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Enter OTP to Reset Password</h2>
        <form method="POST" action="verify_otp.php">
            <label for="otp">Enter OTP:</label>
            <input type="text" name="otp" id="otp" required placeholder="Enter the OTP">
            <input type="submit" value="Verify OTP">
        </form>
    </div>
</body>
</html>
