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
    $household_number = htmlspecialchars(strip_tags($_POST['household_number']));
    $fname = ucfirst(htmlspecialchars(strip_tags($_POST['fname'])));
    $mname = ucfirst(htmlspecialchars(strip_tags($_POST['mname'])));
    $lname = ucfirst(htmlspecialchars(strip_tags($_POST['lname'])));
    $suffix = ucfirst(htmlspecialchars(strip_tags($_POST['suffix'])));
    $gender = ucfirst(htmlspecialchars(strip_tags($_POST['gender'])));
    $dob = htmlspecialchars(strip_tags($_POST['dob']));
    $civil_status = ucfirst(htmlspecialchars(strip_tags($_POST['civil_status'])));
    $nationality = ucfirst(htmlspecialchars(strip_tags($_POST['nationality'])));
    $religion = ucfirst(htmlspecialchars(strip_tags($_POST['religion'])));
    $purok = htmlspecialchars(strip_tags($_POST['purok']));
    $address = htmlspecialchars(strip_tags($_POST['address']));
    $mobile = htmlspecialchars(strip_tags($_POST['mobile']));
    $email = htmlspecialchars(strip_tags($_POST['email']));
    $voter_status = htmlspecialchars(strip_tags($_POST['voter_status']));
    $precinct_number = htmlspecialchars(strip_tags($_POST['precinct_number']));
    $philhealth_number = htmlspecialchars(strip_tags($_POST['philhealth_number']));
    $sss_gsis_number = htmlspecialchars(strip_tags($_POST['sss_gsis_number']));
    $tin_number = htmlspecialchars(strip_tags($_POST['tin_number']));
    $educational_attainment = htmlspecialchars(strip_tags($_POST['educational_attainment']));
    $employment_status = htmlspecialchars(strip_tags($_POST['employment_status']));
    $occupation = htmlspecialchars(strip_tags($_POST['occupation']));
    $monthly_annual_income = htmlspecialchars(strip_tags($_POST['monthly_annual_income']));
    $pwd_status = htmlspecialchars(strip_tags($_POST['pwd_status']));
    $solo_parent_status = htmlspecialchars(strip_tags($_POST['solo_parent_status']));
    $relationship_household_head = htmlspecialchars(strip_tags($_POST['relationship_household_head']));
    $head_of_the_family = htmlspecialchars(strip_tags($_POST['head_of_the_family']));
    $type_of_dwelling = htmlspecialchars(strip_tags($_POST['type_of_dwelling']));
    $health_condition = htmlspecialchars(strip_tags($_POST['health_condition']));
    $vaccination_status = htmlspecialchars(strip_tags($_POST['vaccination_status']));
    $blood_type = htmlspecialchars(strip_tags($_POST['blood_type']));
    $beneficiary_program = htmlspecialchars(strip_tags($_POST['beneficiary_program']));
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
        if ($resident->create($household_number, $fname, $mname, $lname, $suffix, $gender, $dob, $civil_status, $nationality, $religion, $purok, $address, $mobile, $email, $voter_status, $precinct_number, $philhealth_number, $sss_gsis_number, $tin_number, $educational_attainment, $employment_status, $occupation, $monthly_annual_income, $pwd_status, $solo_parent_status, $relationship_household_head, $head_of_the_family, $type_of_dwelling, $health_condition, $vaccination_status, $blood_type, $beneficiary_program, $emergency_contact_person, $emergency_contact_relationship, $emergency_contact_number)) {
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
