<?php
require_once '../includes/db.php';
require_once '../models/Resident.php';

$database = new Database();
$db = $database->connect();
$resident = new Resident($db);

// Call the function to get the count of residents aged 60 and up
$total_60_and_up = $resident->countResidents60AndUp();

$total_female = $resident->countFemales();
$total_male = $resident->countMales();

//echo json_encode($total_60_and_up);


?>
