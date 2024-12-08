<?php
require_once '../includes/db.php';
require_once '../models/Resident.php';

$database = new Database();
$db = $database->connect();
$resident_household = new Resident($db);

// $resident = $resident->householdMember($id, $household_number);
// echo json_encode($resident);

?>
