<?php
session_start();
require_once '../dompdf/vendor/autoload.php';
require_once '../includes/db.php';  
use Dompdf\Dompdf;
use Dompdf\Options;

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SESSION['role'] !== 'admin') {
    header('Location: ../views/login.php');
    exit;
}


$firstName = htmlspecialchars($_POST['certFirstName']);
$middleName = htmlspecialchars($_POST['certMiddleName']);
$lastName = htmlspecialchars($_POST['certLastName']);
$civilStatus = htmlspecialchars($_POST['civil_status']);
$purok = htmlspecialchars($_POST['certPurok']);
$purpose = htmlspecialchars($_POST['certPurpose']);
$issuedDate = htmlspecialchars($_POST['issuedDate']);
$day = date('j', strtotime($issuedDate));
$month = date('F', strtotime($issuedDate));
$year = date('Y', strtotime($issuedDate));
$logoPath = '../assets/img/bulwalogo.png';  

if (!file_exists($logoPath)) {
    die("Logo file not found at path: " . $logoPath);
}

$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true); 
$dompdf = new Dompdf($options);


$html = "
    <html>
        <head>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    font-size: 14px;
                }
                .header {
                    text-align: center;
                    margin-bottom: 20px;
                }
                .header h2, .header h3 {
                    margin: 0;
                    padding: 0;
                }
                .header .logo {
                    width: 100px;
                    position: absolute;
                    left: 20px;
                    top: 30px;
                }
                .content {
                    text-align: justify;
                    margin-top: 30px;
                    line-height: 1.5;
                    margin-left: 30px;
                    margin-right: 30px;
                }
                .footer {
                    text-align: left;
                    margin-top: 50px;
                    margin-left: 30px;
                }
                .certificate-title {
                    font-size: 18px;
                    font-weight: bold;
                    border-bottom: 2px solid black; /* Underline with extended border */
                    padding-left: 20px;  /* Adjusted to 20px */
                    padding-right: 20px; /* Adjusted to 20px */
                }
                .signature {
                    margin-top: 30px;
                }
            </style>
        </head>
        <body>
            <div class='header'>
                <img src='$logoPath' alt='Bulwa Logo' class='logo' />
                <h2>REPUBLIC OF THE PHILIPPINES</h2>
                <h3>PROVINCE OF MISAMIS ORIENTAL</h3>
                <h3>MUNICIPALITY OF MEDINA</h3>
                <h3>BARANGAY OF BULWA</h3>
                <p class='certificate-title'>OFFICE OF THE PUNONG BARANGAY</p>
                <h2>CERTIFICATE OF INDIGENCY</h2>
            </div>
            <div class='content'>
                <p>TO WHOM IT MAY CONCERN:</p>
                <p>This is to certify that <strong>$firstName $middleName $lastName</strong>, of legal age, $civilStatus, resident of Purok-$purok, Bulwa, Medina, Misamis Oriental, has a family with low average income.</p>
                <p>This certificate of indigence is being issued upon the request of the above name mentioned for  <strong>$purpose</strong> purposes.</p>
                 <p>Given this <strong>$day</strong>th day of <strong>$month</strong>, <strong>$year</strong> at Barangay Bulwa, Medina, Misamis Oriental.</p>
            </div>
            <div class='footer'>
               
                <div class='signature'>
                    <p><strong>(Name of Punong Barangay)</strong></p>
                    <p>Punong Barangay</p>
                </div>
            </div>
        </body>
    </html>";

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("certificate_of_indigency.pdf", array("Attachment" => 0));

exit;
?>
