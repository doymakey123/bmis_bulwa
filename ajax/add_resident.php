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
    $fname = ucfirst(htmlspecialchars(strip_tags($_POST['fname'])));
    $mname = ucfirst(htmlspecialchars(strip_tags($_POST['mname'])));
    $lname = ucfirst(htmlspecialchars(strip_tags($_POST['lname'])));
    $suffix = ucfirst(htmlspecialchars(strip_tags($_POST['suffix'])));
    $gender = ucfirst(htmlspecialchars(strip_tags($_POST['gender'])));
    $dob = htmlspecialchars(strip_tags($_POST['dob']));
    $civil_status = ucfirst(htmlspecialchars(strip_tags($_POST['civil_status'])));
    $nationality = ucfirst(htmlspecialchars(strip_tags($_POST['nationality'])));
    $religion = ucfirst(htmlspecialchars(strip_tags($_POST['religion'])));
    $mobile = htmlspecialchars(strip_tags($_POST['mobile']));
    $email = htmlspecialchars(strip_tags($_POST['email']));
    $house_number = htmlspecialchars(strip_tags($_POST['house_number']));
    $purok = ucfirst(htmlspecialchars(strip_tags($_POST['purok'])));
    $brgy = ucfirst(htmlspecialchars(strip_tags($_POST['brgy'])));
    $head_of_family = ucfirst(htmlspecialchars(strip_tags($_POST['head_of_family'])));
    $household_composition = ucfirst(htmlspecialchars(strip_tags($_POST['household_composition'])));
    $educational_attainment = ucfirst(htmlspecialchars(strip_tags($_POST['educational_attainment'])));
    $occupation = ucfirst(htmlspecialchars(strip_tags($_POST['occupation'])));
    $type_of_residency = ucfirst(htmlspecialchars(strip_tags($_POST['type_of_residency'])));
    $blood_type = htmlspecialchars(strip_tags($_POST['blood_type']));
    $disabilities = ucfirst(htmlspecialchars(strip_tags($_POST['disabilities'])));
    $beneficiary_status = ucfirst(htmlspecialchars(strip_tags($_POST['beneficiary_status'])));
    $precinct_number = htmlspecialchars(strip_tags($_POST['precinct_number']));
    $voter_status = htmlspecialchars(strip_tags($_POST['voter_status']));
    $emergency_contact_person = ucfirst(htmlspecialchars(strip_tags($_POST['emergency_contact_person'])));
    $emergency_contact_relationship = ucfirst(htmlspecialchars(strip_tags($_POST['emergency_contact_relationship'])));
    $emergency_contact_number = htmlspecialchars(strip_tags($_POST['emergency_contact_number']));

    $dob = date('m/d/Y', strtotime($dob));

    // Check if resident already exists
    $query = "SELECT * FROM tbl_resident WHERE fname = :fname AND mname = :mname AND lname = :lname AND suffix = :suffix";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':fname', $fname);
    $stmt->bindParam(':mname', $mname);
    $stmt->bindParam(':lname', $lname);
    $stmt->bindParam(':suffix', $suffix);

    if ($stmt->execute() && $stmt->rowCount() > 0) {
        // Resident already exists
        echo json_encode([
            'success' => false,
            'message' => 'Resident data already exists in the database.'
        ]);

            // Validate session variables before logging activity
            if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
                $descriptionLog = $fname . ' ' . $mname . ' ' . $lname . ' ' . $suffix . 'resident data already exist';
                $userActivityLog->create($_SESSION['id'], $_SESSION['role'], 'Add', $descriptionLog);
            } else {
                // Handle missing session variables
                error_log('Activity log error: Missing session variables for user ID or role.');
            }


    } else {
        // Add new resident
        if ($resident->create($fname, $mname, $lname, $suffix, $gender, $dob, $civil_status, $nationality, $religion, $mobile, $email, $house_number, $purok, $brgy, $head_of_family, $household_composition, $educational_attainment, $occupation, $type_of_residency, $blood_type, $disabilities, $beneficiary_status, $precinct_number, $voter_status, $emergency_contact_person, $emergency_contact_relationship, $emergency_contact_number)) {
            echo json_encode(['success' => true, 'message' => 'Resident added successfully']);

            // Validate session variables before logging activity
            if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
                $descriptionLog = $fname . ' ' . $mname . ' ' . $lname . ' ' . $suffix . 'resident added successfully';
                $userActivityLog->create($_SESSION['id'], $_SESSION['role'], 'Add', $descriptionLog);
            } else {
                // Handle missing session variables
                error_log('Activity log error: Missing session variables for user ID or role.');
            }

        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to add resident']);

            // Validate session variables before logging activity
            if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
                $descriptionLog = $fname . ' ' . $mname . ' ' . $lname . ' ' . $suffix . ' failed to add resident';
                $userActivityLog->create($_SESSION['id'], $_SESSION['role'], 'Add ', $descriptionLog);
            } else {
                // Handle missing session variables
                error_log('Activity log error: Missing session variables for user ID or role.');
            }
        }
    }

}
?>
