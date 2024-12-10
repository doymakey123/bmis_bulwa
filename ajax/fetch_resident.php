<?php
// require_once '../includes/db.php';
// require_once '../models/Resident.php';

// $database = new Database();
// $db = $database->connect();
// $resident = new Resident($db);

// $resident = $resident->fetchAll();
// echo json_encode($resident);



require_once '../includes/db.php';
require_once '../models/Resident.php';

$database = new Database();
$db = $database->connect();
$resident = new Resident($db);

// Get purok filter from request
$purok = isset($_GET['purok']) && $_GET['purok'] !== 'all' ? $_GET['purok'] : null;

// Fetch residents based on purok
$residents = $resident->fetchAll($purok);

echo json_encode($residents);


?>
