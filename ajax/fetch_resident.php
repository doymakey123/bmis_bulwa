<?php
// require_once '../includes/db.php';
// require_once '../models/Resident.php';

// $database = new Database();
// $db = $database->connect();
// $resident = new Resident($db);

// $resident = $resident->fetchAll();
// echo json_encode($resident);



// require_once '../includes/db.php';
// require_once '../models/Resident.php';

// $database = new Database();
// $db = $database->connect();
// $resident = new Resident($db);

// // Get purok filter from request
// $purok = isset($_GET['purok']) && $_GET['purok'] !== 'all' ? $_GET['purok'] : null;

// // Fetch residents based on purok
// $residents = $resident->fetchAll($purok);

// echo json_encode($residents);

require_once '../includes/db.php';
require_once '../models/Resident.php';

$database = new Database();
$db = $database->connect();
$resident = new Resident($db);

// Fetch filters
$purok = isset($_GET['purok']) ? $_GET['purok'] : '';
$voter_status = isset($_GET['voter_status']) ? $_GET['voter_status'] : '';
$employment_status = isset($_GET['employment_status']) ? $_GET['employment_status'] : '';

// Fetch residents with filters
$residents = $resident->fetchFiltered($purok, $voter_status, $employment_status);
echo json_encode($residents);



?>
