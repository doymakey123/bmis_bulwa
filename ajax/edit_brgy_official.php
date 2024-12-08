<?php
require_once '../includes/db.php';
require_once '../models/Brgyofficial.php';

$database = new Database();
$db = $database->connect();
$brgyofficial = new Brgyofficial($db);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $fname = ucfirst(htmlspecialchars(strip_tags($_POST['fname'])));
    $mname = ucfirst(htmlspecialchars(strip_tags($_POST['mname'])));
    $lname = ucfirst(htmlspecialchars(strip_tags($_POST['lname'])));
    $suffix = ucfirst(htmlspecialchars(strip_tags($_POST['suffix'])));
    $position = htmlspecialchars(strip_tags($_POST['position']));
    $rank = htmlspecialchars(strip_tags($_POST['rank']));
    $assign_area = ucfirst(htmlspecialchars(strip_tags($_POST['assign_area'])));
    $committee = ucfirst(htmlspecialchars(strip_tags($_POST['committee'])));
    $term = ucfirst(htmlspecialchars(strip_tags($_POST['term'])));
    $year_elected = ucfirst(htmlspecialchars(strip_tags($_POST['year_elected'])));
    $status = htmlspecialchars(strip_tags($_POST['status']));
    
   
    if ($brgyofficial->update($id, $fname, $mname, $lname, $suffix, $position, $rank, $assign_area, $committee, $term, $year_elected, $status)) {
        echo json_encode(['success' => true, 'message' => 'BRGY official updated successfully']);

        
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update BRGY official']);

    }
}
?>
