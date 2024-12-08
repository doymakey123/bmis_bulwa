<?php
require_once '../includes/db.php';
require_once '../models/Sk.php';

$database = new Database();
$db = $database->connect();
$skofficial = new Sk($db);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
    


    // Check if SK Official already exists
    if ($skofficial->exists($fname, $mname, $lname, $suffix, $year_elected)) {
        echo json_encode(['success' => false, 'message' => 'SK official data already exists.']);
    } else {
        // Add new SK Official
        $result = $skofficial->create($fname, $mname, $lname, $suffix, $position, $rank, $assign_area, $committee, $term, $year_elected, $status);
        echo json_encode($result);
    }



}
?>
