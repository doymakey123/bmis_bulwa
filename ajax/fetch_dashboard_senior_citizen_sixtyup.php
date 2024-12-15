<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'db_bmis_bulwa';

// Database connection
$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Calculate the dynamic year range
$currentYear = date('Y');
$startYear = $currentYear - 4;

// Query to calculate senior citizens (aged 60+) grouped by year
$sql = "SELECT 
            YEAR(date_created) AS year,
            COUNT(*) AS senior_count
        FROM tbl_resident
        WHERE YEAR(CURDATE()) - YEAR(STR_TO_DATE(dob, '%m/%d/%Y')) >= 60
          AND YEAR(date_created) BETWEEN $startYear AND $currentYear
        GROUP BY YEAR(date_created)
        ORDER BY YEAR(date_created) ASC";


$result = $conn->query($sql);

// Check for SQL errors
if (!$result) {
    die("SQL error: " . $conn->error);
}

// Prepare the data for JSON response
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
