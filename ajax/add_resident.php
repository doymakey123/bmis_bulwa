<?php
require_once '../includes/db.php';
require_once '../models/Resident.php';

$database = new Database();
$db = $database->connect();
$resident = new Resident($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars(strip_tags($_POST['name']));
    $email = htmlspecialchars(strip_tags($_POST['email']));
    $age = intval($_POST['age']);

    if ($resident->create($name, $email, $age)) {
        echo json_encode(['success' => true, 'message' => 'Resident added successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to add resident']);
    }
}
?>
