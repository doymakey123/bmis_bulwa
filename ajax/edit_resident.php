<?php
require_once '../includes/db.php';
require_once '../models/Resident.php';

$database = new Database();
$db = $database->connect();
$resident = new Resident($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    // $name = htmlspecialchars(strip_tags($_POST['name']));
    // $email = htmlspecialchars(strip_tags($_POST['email']));
    // $age = intval($_POST['age']);
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
    $emergency_contact_person = ucfirst(htmlspecialchars(strip_tags($_POST['emergency_contact_person'])));
    $emergency_contact_relationship = ucfirst(htmlspecialchars(strip_tags($_POST['emergency_contact_relationship'])));
    $emergency_contact_number = htmlspecialchars(strip_tags($_POST['emergency_contact_number']));

    $dob = date('m/d/Y', strtotime($dob));

    if ($resident->update($id, $fname, $mname, $lname, $suffix, $gender, $dob, $civil_status, $nationality, $religion, $mobile, $email, $house_number, $purok, $brgy, $head_of_family, $household_composition, $educational_attainment, $occupation, $type_of_residency, $blood_type, $disabilities, $beneficiary_status, $emergency_contact_person, $emergency_contact_relationship, $emergency_contact_number)) {
        echo json_encode(['success' => true, 'message' => 'Resident updated successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update resident']);
    }
}
?>
