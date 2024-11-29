<?php
require_once '../includes/db.php';
require_once '../models/Blotter.php';

$database = new Database();
$db = $database->connect();
$blotter = new Blotter($db);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $complainant_fname = ucfirst(htmlspecialchars(strip_tags($_POST['complainant_fname'])));
    $complainant_mname = ucfirst(htmlspecialchars(strip_tags($_POST['complainant_mname'])));
    $complainant_lname = ucfirst(htmlspecialchars(strip_tags($_POST['complainant_lname'])));
    $complainant_suffix = ucfirst(htmlspecialchars(strip_tags($_POST['complainant_suffix'])));
    $complainant_contact = htmlspecialchars(strip_tags($_POST['complainant_contact']));
    $complainant_address = htmlspecialchars(strip_tags($_POST['complainant_address']));
    $respondent_fname = ucfirst(htmlspecialchars(strip_tags($_POST['respondent_fname'])));
    $respondent_mname = ucfirst(htmlspecialchars(strip_tags($_POST['respondent_mname'])));
    $respondent_lname = ucfirst(htmlspecialchars(strip_tags($_POST['respondent_lname'])));
    $respondent_contact = htmlspecialchars(strip_tags($_POST['respondent_contact']));
    $blotter_type = htmlspecialchars(strip_tags($_POST['blotter_type']));
    $details = htmlspecialchars(strip_tags($_POST['details']));
    $status = htmlspecialchars(strip_tags($_POST['status']));


    // Check if blotter already exists
    $query = "SELECT * FROM tbl_blotter WHERE complainant_fname = :complainant_fname AND complainant_mname = :complainant_mname AND complainant_lname = :complainant_lname AND complainant_suffix = :complainant_suffix AND respondent_fname = :respondent_fname AND respondent_mname = :respondent_mname AND respondent_lname = :respondent_lname AND respondent_suffix = :respondent_suffix";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':complainant_fname', $complainant_fname);
    $stmt->bindParam(':complainant_mname', $complainant_mname);
    $stmt->bindParam(':complainant_lname', $complainant_lname);
    $stmt->bindParam(':complainant_suffix', $complainant_suffix);
    $stmt->bindParam(':respondent_fname', $respondent_fname);
    $stmt->bindParam(':respondent_mname', $respondent_mname);
    $stmt->bindParam(':respondent_lname', $respondent_lname);
    $stmt->bindParam(':respondent_suffix', $respondent_suffix);

    if ($stmt->execute() && $stmt->rowCount() > 0) {
        // Blotter already exists
        echo json_encode([
            'success' => false,
            'message' => 'Blotter data already exists in the database.'
        ]);
    } else {
        // Add new resident
        if ($blotter->create($complainant_fname, $complainant_mname, $complainant_lname, $complainant_suffix, $complainant_address, $complainant_contact, $respondent_fname, $respondent_mname, $respondent_lname, $respondent_suffix, $respondent_contact, $blotter_type, $details, $status)) {
            echo json_encode(['success' => true, 'message' => 'Blotter added successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to add blotter']);
        }
    }

}
?>
