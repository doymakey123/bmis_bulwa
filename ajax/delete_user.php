<?php
require_once '../includes/db.php';
require_once '../models/User.php';

$database = new Database();
$db = $database->connect();
$user = new User($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);

    if ($user->delete($id)) {
        echo json_encode(['success' => true, 'message' => 'User account deleted successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete user account']);
    }
}
?>
