<?php

require_once '../includes/db.php';
require_once '../models/Resident.php';

$database = new Database();
$db = $database->connect();
$residentSenior = new Resident($db);


// Fetch residents with filters
$residentSenior = $residentSenior->fetchAllSeniorCitizens();
echo json_encode($residentSenior);


?>