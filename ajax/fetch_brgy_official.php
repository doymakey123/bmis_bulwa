<?php
require_once '../includes/db.php';
require_once '../models/Brgyofficial.php';

$database = new Database();
$db = $database->connect();
$brgy = new Brgyofficial($db);


$brgy = $brgy->fetchAll();
echo json_encode($brgy);


?>
