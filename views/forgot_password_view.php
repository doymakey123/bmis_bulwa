
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Forgot Password</h2>
        <form method="POST" action="forgot_password.php">
            <label for="email">Enter your email:</label>
            <input type="email" name="email" id="email" required placeholder="Your Email Address">
            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
