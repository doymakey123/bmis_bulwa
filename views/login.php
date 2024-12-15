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
    <link rel="icon" href="../assets/img/bulwalogo.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    
</head>
<body>

    <div class="comtainer">

        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <img src="../assets/img/bulwalogo.png" class="rounded mx-auto d-block" style="width: 300px; height:300px;" alt="">
            </div>
            <div class="col-md-4"></div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <?php if ($error): ?>
                    <p style="color: red;"><?php echo $error; ?></p>
                <?php endif; ?>
            </div>
            <div class="col-md-4"></div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4" style="text-align: center;">
                <form method="POST">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="info-btn btn btn-primary">Login</button>
                    </div>
                    <div class="form-group">
                    <a href="forgot_password.php" style="color: blue; text-decoration: none;">Forgot Password?</a>
                    </div>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>




    </div>
    
</body>
</html>


                
