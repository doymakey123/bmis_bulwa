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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    
</head>
<body class="bg-gradient-primary">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-12 col-xl-10" style="margin-top: 200px;">
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-flex"><img class="img-fluid" style="min-width: 440px;max-height: 440px;" src="../assets/img/bulwalogo.png"></div>
                            <div class="col-lg-6">
                                <div class="p-5" style="margin-top: 32px;">
                                    <div class="text-center">
                                        <h3 class="text-dark mb-4">Welcome Back!</h3>
                                    </div>

                                    <?php if ($error): ?>
                                        <p style="color: red;"><?php echo $error; ?></p>
                                    <?php endif; ?>

                                    <!-- Login form -->
                                    <form class="user" method="post" id="login_form">
                                        <div class="input-group mb-3">
                                            <input type="text" name="username" class="form-control form-control-user" placeholder="Username" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2"><a><i class="fas fa-grin-beam" aria-hidden="true"></i></a></span>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3" id="show_hide_password">
                                            <input type="password" name="password" class="form-control form-control-user" id="password" placeholder="Password" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2"><i class="fas fa-eye-slash" id="togglePassword" aria-hidden="true"></i></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <div class="form-check">
                                                    <input class="form-check-input custom-control-input" type="checkbox" id="formCheck-1">
                                                    <label class="form-check-label custom-control-label" for="formCheck-1">Remember Me</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Forgot Password link -->
                                        <div class="text-center">
                                            <a class="small" href="forgot_password.php" >Forgot Password?</a>
                                        </div>
                                        <input class="btn btn-primary btn-block text-white btn-user" type="submit" name="submit_login" value="Login">
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>

    <script>

        document.getElementById("togglePassword").addEventListener("click", function () {
        const passwordField = document.getElementById("password");
        const type = passwordField.type === "password" ? "text" : "password";
        passwordField.type = type;

        // Toggle the icon
        this.classList.toggle("fa-eye");
        this.classList.toggle("fa-eye-slash");
        });
        
    </script>


</body>
</html>


                
