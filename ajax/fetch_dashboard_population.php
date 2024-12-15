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

// Calculate the dynamic year range in PHP
$currentYear = date('Y');
$startYear = $currentYear - 4;

// Correct SQL query to fetch population data
$sql = "SELECT 
            YEAR(date_created) AS year, 
            COUNT(*) AS population 
        FROM tbl_resident 
        WHERE YEAR(date_created) BETWEEN $startYear AND $currentYear 
        GROUP BY year";

$result = $conn->query($sql);

// Check for SQL errors
if (!$result) {
    die("SQL error: " . $conn->error);
}

// Fetch and prepare the data
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
