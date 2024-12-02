<?php
session_start();
require_once '../includes/db.php';
require_once '../models/User.php';
require_once '../models/Activitylog.php';


$database = new Database();
$db = $database->connect();
$user = new User($db);
$userActivityLog = new Activitylog($db);

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Sanitize inputs
    $username = htmlspecialchars(strip_tags($username));
    $password = htmlspecialchars(strip_tags($password));

    $loggedInUser = $user->login($username, $password);

    if ($loggedInUser) {

        $_SESSION['username'] = $loggedInUser['username'];
        $_SESSION['role'] = $loggedInUser['role'];
        $_SESSION['id'] = $loggedInUser['id'];

        $userActivityLog = $userActivityLog->create($_SESSION['id'], $_SESSION['role'], 'login', 'succesfully');


        // Redirect based on role
        header('Location: ../views/' . $loggedInUser['role'] . '.php');
        exit;
    } else {
        $error = 'Invalid username or password!';
        $userActivityLog = $userActivityLog->create('0', $username, 'login', 'failed');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="container">
        <form method="POST">
            <h2>Login</h2>
            <?php if ($error): ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>
            <label for="username">Username:</label>
            <input type="text" name="username" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
