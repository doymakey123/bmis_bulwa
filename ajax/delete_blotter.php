<?php
require_once '../includes/db.php';
require_once '../models/Blotter.php';

$database = new Database();
$db = $database->connect();
$blotter = new Blotter($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);

    if ($blotter->delete($id)) {
        echo json_encode(['success' => true, 'message' => 'Blotter deleted successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete blotter']);
    }
}
?>
