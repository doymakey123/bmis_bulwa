<?php
require_once '../includes/db.php';
require_once '../models/Activitylog.php';

$database = new Database();
$db = $database->connect();
$activitylog = new Activitylog($db);

$activitylog = $activitylog->fetchAll();
echo json_encode($activitylog);

?>
