<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Welcome, Admin!</h1>
    <button id="generate-pdf">Download Report</button>
    <a href="resident.php">Resident</a>
    <a href="../logout.php">Logout</a>
    <script src="../assets/pdf/jspdf.min.js"></script>
    <script>
        document.getElementById('generate-pdf').addEventListener('click', () => {
            const doc = new jsPDF();
            doc.text('Admin Report', 10, 10);
            doc.save('report.pdf');
        });
    </script>
</body>
</html>
