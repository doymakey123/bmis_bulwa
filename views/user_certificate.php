<?php
session_start();
if ($_SESSION['role'] !== 'user') {
    header('Location: ../views/login.php');
    exit;
}

include("../includes/header.php");
include("../includes/navuser.php");
require_once '../includes/db.php';
require_once '../models/Resident.php';  

$database = new Database();
$db = $database->connect();
$residentModel = new Resident($db);
$residents = $residentModel->fetchAll();

if ($residents === false || empty($residents)) {
    echo "No residents found.";
    exit;
}
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<style>
    #searchBar {
        width: 200px; 
        float: right; 
        margin-bottom: 15px; 
    }
</style>

<div class="container-fluid">
    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#generateModal">Generate Certificate</button>
    <input type="text" id="searchBar" class="form-control" placeholder="Search residents..." />

    <!-- Filter Dropdown -->
    <div>
        <label for="filter-purok">Filter by Purok:</label>
        <select id="filter-purok" name="purok">
            <option value="">All</option>
            <option value="1">Purok 1</option>
            <option value="2">Purok 2</option>
            <option value="3">Purok 3</option>
            <option value="4">Purok 4</option>
        </select>
    </div>

    <table class="table table-bordered" id="residentTable" style="width: 100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Suffix Name</th>
                <th>Age</th>
                <th>Birthday</th>
                <th>Purok</th>
                <th>Occupation</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($residents as $resident): ?>
                <tr>
                    <td><?php echo htmlspecialchars($resident['id']); ?></td>
                    <td><?php echo htmlspecialchars($resident['fname']); ?></td>
                    <td><?php echo htmlspecialchars($resident['mname']); ?></td>
                    <td><?php echo htmlspecialchars($resident['lname']); ?></td>
                    <td><?php echo htmlspecialchars($resident['suffix']); ?></td>
                    <td><?php echo htmlspecialchars($resident['age']); ?></td>
                    <td><?php echo htmlspecialchars($resident['formatted_birthday']); ?></td>
                    <td><?php echo htmlspecialchars($resident['purok']); ?></td>
                    <td><?php echo htmlspecialchars($resident['occupation']); ?></td>
                    <td>

                        <button class="btn btn-info generate-btn" 
                            data-id="<?php echo htmlspecialchars($resident['id']); ?>" 
                            data-fname="<?php echo htmlspecialchars($resident['fname']); ?>" 
                            data-mname="<?php echo htmlspecialchars($resident['mname']); ?>" 
                            data-lname="<?php echo htmlspecialchars($resident['lname']); ?>" 
                            data-civil_status="<?php echo htmlspecialchars($resident['civil_status']); ?>"
                            data-purok="<?php echo htmlspecialchars($resident['purok']); ?>" 
                            data-purpose="<?php echo htmlspecialchars($resident['purpose'] ?? ''); ?>" 
                            data-issued_date="<?php echo htmlspecialchars($resident['issued_date'] ?? ''); ?>"
                        >Generate</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

<!-- Modal-->
<div class="modal fade" id="generateModal" tabindex="-1" role="dialog" aria-labelledby="generateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="generateModalLabel">Generate Certificate</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="certificateForm" method="POST" action="generate_certificate.php">
                    <input type="hidden" id="certId" name="certId">
                    <div class="form-group">
                        <label for="certFirstName">Firstname</label>
                        <input type="text" class="form-control" id="certFirstName" name="certFirstName" required>
                    </div>
                    <div class="form-group">
                        <label for="certMiddleName">Middlename</label>
                        <input type="text" class="form-control" id="certMiddleName" name="certMiddleName" required>
                    </div>
                    <div class="form-group">
                        <label for="certLastName">Lastname</label>
                        <input type="text" class="form-control" id="certLastName" name="certLastName" required>
                    </div>
                    <div class="form-group">
                        <label for="civil_status">Civil Status</label>
                        <select class="custom-select" id="civil_status" name="civil_status" required>
                            <option value="">Select Option</option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Separated or Divorced">Separated or Divorced</option>
                            <option value="Widowed">Widowed</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="certPurok">Purok</label>
                        <input type="text" class="form-control" id="certPurok" name="certPurok" required>
                    </div>
                    <div class="form-group">
                        <label for="certPurpose">Purpose</label>
                        <input type="text" class="form-control" id="certPurpose" name="certPurpose" required>
                    </div>
                    <div class="form-group">
                        <label for="issuedDate">Issued Date</label>
                        <input type="date" class="form-control" id="issuedDate" name="issuedDate" required>
                    </div>
                    <button type="submit" class="btn btn-success">Generate Certificate</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Include Popper.js and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>

    $('#header_name_exchangeable').text('Barangay Certificate'); // Change text description


    $(document).ready(function() {
        $('#residentTable').DataTable({
            "searching": false  
        });
        $("#filter-purok").on("change", function() {
            var selectedPurok = $(this).val();
            $("#residentTable tbody tr").filter(function() {
                $(this).toggle(selectedPurok === "" || $(this).find("td:eq(7 )").text() === selectedPurok);
            });
        });
        $("#searchBar").on("keyup", function() {
            var searchTerm = $(this).val().toLowerCase();
            $("#residentTable tbody tr").each(function() {
                var rowText = $(this).text().toLowerCase();
                if (rowText.indexOf(searchTerm) !== -1) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
    $(".btn.btn-primary.mb-3").on("click", function() {
        $("#certFirstName").val('');
        $("#certMiddleName").val('');
        $("#certLastName").val('');
        $("#civil_status").val('');
        $("#certPurok").val('');
        $("#certPurpose").val('');
        $("#issuedDate").val('');
        $("#generateModal").modal("show");
    });

    $(".generate-btn").on("click", function() {
        var id = $(this).data("id");
        var firstname = $(this).data("fname");
        var middlename = $(this).data("mname");
        var lastname = $(this).data("lname");
        var status = $(this).data("civil_status");
        var purok = $(this).data("purok");
        var purpose = $(this).data("purpose") ?? '';  
        var issued_date = $(this).data("issued_date") || '';  

        $("#certId").val(id);
        $("#certFirstName").val(firstname);
        $("#certMiddleName").val(middlename);
        $("#certLastName").val(lastname);
        $("#civil_status").val(status);
        $("#certPurok").val(purok);  
        $("#certPurpose").val(purpose);  
        $("#issuedDate").val(issued_date);  
        $("#generateModal").modal("show");
    });
</script>

</body>
</html>