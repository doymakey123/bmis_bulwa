<?php
require_once '../includes/db.php';
require_once '../models/Blotter.php';

$database = new Database();
$db = $database->connect();
$blotter = new Blotter($db);

$blotter = $blotter->fetchAll();
echo json_encode($blotter);

?>
