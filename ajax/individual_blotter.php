
<?php
require_once '../includes/db.php';
require_once '../models/Blotter.php';

$database = new Database();
$db = $database->connect();
$blotter = new Blotter($db);

//$blotter = $blotter->individual(1);
//echo json_encode($blotter);

?>
