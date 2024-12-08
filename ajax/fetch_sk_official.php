<?php
require_once '../includes/db.php';
require_once '../models/Sk.php';

$database = new Database();
$db = $database->connect();
$sk = new Sk($db);


$sk = $sk->fetchAll();
echo json_encode($sk);


?>
