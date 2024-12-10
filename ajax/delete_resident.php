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


<?php
// require_once '../includes/db.php';
// require_once '../models/Resident.php';
// require_once '../models/Activitylog.php';

// session_start();

// $database = new Database();
// $db = $database->connect();
// $resident = new Resident($db);
// $userActivityLog = new Activitylog($db);

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $id = intval($_POST['id']);
//     $uploadDir = '../uploads/residents/';

//     // Fetch the resident's image path
//     $query = "SELECT image_path FROM residents WHERE id = ?";
//     $stmt = $db->prepare($query);
//     $stmt->execute([$id]);
//     $imagePath = $stmt->fetchColumn();

//     // Proceed with deletion
//     if ($resident->delete($id)) {
//         // Delete the image file if it exists
//         if ($imagePath && file_exists($uploadDir . $imagePath)) {
//             unlink($uploadDir . $imagePath);
//         }

//         // Log the activity
//         if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
//             $descriptionLog = 'Resident ID: ' . $id . ' deleted successfully';
//             $userActivityLog->create($_SESSION['id'], $_SESSION['role'], 'Delete', $descriptionLog);
//         }

//         echo json_encode(['success' => true, 'message' => 'Resident deleted successfully']);
//     } else {
//         echo json_encode(['success' => false, 'message' => 'Failed to delete resident']);
//     }
// }
?>
