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
    $respondent_suffix = ucfirst(htmlspecialchars(strip_tags($_POST['respondent_suffix'])));
    $respondent_contact = htmlspecialchars(strip_tags($_POST['respondent_contact']));
    $blotter_type = htmlspecialchars(strip_tags($_POST['blotter_type']));
    $details = htmlspecialchars(strip_tags($_POST['details']));
    $status = htmlspecialchars(strip_tags($_POST['status']));
    $date_created = date('Y-m-d');


    // Check if blotter already exists
    if ($blotter->exists($complainant_fname, $complainant_mname, $complainant_lname, $complainant_suffix, $respondent_fname, $respondent_mname, $respondent_lname, $respondent_suffix, $date_created)) {
        echo json_encode(['success' => false, 'message' => 'Blotter data already exists.']);
    } else {
        // Add new blotter
        $result = $blotter->create($complainant_fname, $complainant_mname, $complainant_lname, $complainant_suffix, $complainant_address, $complainant_contact, $respondent_fname, $respondent_mname, $respondent_lname, $respondent_suffix, $respondent_contact, $blotter_type, $details, $status);
        echo json_encode($result);
    }



}
?>
