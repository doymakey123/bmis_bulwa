<?php
require_once '../includes/db.php';
require_once '../models/Resident.php';

$database = new Database();
$db = $database->connect();
$resident = new Resident($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $name = htmlspecialchars(strip_tags($_POST['name']));
    $email = htmlspecialchars(strip_tags($_POST['email']));
    $age = intval($_POST['age']);

    if ($resident->update($id, $name, $email, $age)) {
        echo json_encode(['success' => true, 'message' => 'Resident updated successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update resident']);
    }
}
?>
