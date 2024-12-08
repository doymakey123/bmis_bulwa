<?php
require_once '../includes/db.php';
require_once '../models/Sk.php';

$database = new Database();
$db = $database->connect();
$skofficial = new Sk($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);

    if ($skofficial->delete($id)) {
        echo json_encode(['success' => true, 'message' => 'Sk official deleted successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete Sk official']);
    }
}
?>
