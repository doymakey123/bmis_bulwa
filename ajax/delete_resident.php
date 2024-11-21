<?php
require_once '../includes/db.php';
require_once '../models/Resident.php';

$database = new Database();
$db = $database->connect();
$resident = new Resident($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);

    if ($resident->delete($id)) {
        echo json_encode(['success' => true, 'message' => 'Resident deleted successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete resident']);
    }
}
?>
