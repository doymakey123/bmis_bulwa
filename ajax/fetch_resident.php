<?php
require_once '../includes/db.php';
require_once '../models/Resident.php';

$database = new Database();
$db = $database->connect();
$resident = new Resident($db);

$resident = $resident->fetchAll();
echo json_encode($resident);

?>
