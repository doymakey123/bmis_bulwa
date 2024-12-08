<?php


$host = 'localhost';
$username = 'root';
$password = '';
$database = 'db_bmis_bulwa';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['head_of_the_family'])) {
    $search = $_POST['head_of_the_family'];
    $query = "SELECT * FROM tbl_resident WHERE fname LIKE '%$search%' || mname LIKE '%$search%' || lname LIKE '%$search%'";
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        echo '<span style="cursor:pointer;">' . $row['fname'] . ' ' . $row['mname'] . ' ' . $row['lname'] . ' ' . $row['suffix'] . '</span><br>';
    }
    
}

$conn->close();

?>
