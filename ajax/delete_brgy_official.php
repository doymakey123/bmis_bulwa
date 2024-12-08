<?php
require_once '../includes/db.php';
require_once '../models/Brgyofficial.php';

$database = new Database();
$db = $database->connect();
$brgyofficial = new Brgyofficial($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);

    if ($brgyofficial->delete($id)) {
        echo json_encode(['success' => true, 'message' => 'BRGY official deleted successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete BRGY official']);
    }
}
?>
