<?php
require_once '../includes/db.php';
require_once '../models/Resident.php';
require_once '../models/Activitylog.php';

session_start();


$database = new Database();
$db = $database->connect();
$resident = new Resident($db);
$userActivityLog = new Activitylog($db);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = intval($_POST['id']);



    if ($resident->delete($id)) {
        echo json_encode(['success' => true, 'message' => 'Resident deleted successfully']);

        // Validate session variables before logging activity
        if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
            $descriptionLog = 'Resident ID: '. $id . ' deleted successfully';
            $userActivityLog->create($_SESSION['id'], $_SESSION['role'], 'Delete', $descriptionLog);
        }

    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete resident']);
    }
}
?>
