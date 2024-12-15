<?php

require_once '../includes/db.php';
require_once '../models/Resident.php';

$database = new Database();
$db = $database->connect();
$resident = new Resident($db);



// Fetch residents with 
$residents = $resident->fetchHouseholdNumber();
echo json_encode($residents);



?>