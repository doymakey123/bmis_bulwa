<?php
require_once '../includes/db.php';
require_once '../models/User.php';

$database = new Database();
$db = $database->connect();
$user = new User($db);


$user = $user->fetchAll();
echo json_encode($user);


?>
