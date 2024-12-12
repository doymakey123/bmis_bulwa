<?php
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']); // Ensure the resident ID is valid
    $target_dir = "../upload/resident_images/"; // Directory for storing images
    $image_path = null;

    // Check if a new image is uploaded
    if (isset($_FILES['residentImage']) && $_FILES['residentImage']['error'] === UPLOAD_ERR_OK) {
        $file_name = $id . "_" . time() . "_" . basename($_FILES['residentImage']['name']);
        $target_file = $target_dir . $file_name;

        // Validate file type
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        $file_extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if (!in_array($file_extension, $allowed_types)) {
            echo "<script>alert('Invalid file type. Please upload JPG, PNG, or GIF.'); history.back();</script>";
            exit;
        }

        // Move uploaded file
        if (move_uploaded_file($_FILES['residentImage']['tmp_name'], $target_file)) {
            $image_path = "upload/resident_images/" . $file_name;

            // Delete the old image if a new one is uploaded
            $database = new Database();
            $db = $database->connect();
            $stmt = $db->prepare("SELECT image_path FROM tbl_resident WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $old_image = $stmt->fetchColumn();
            if ($old_image && file_exists("../" . $old_image)) {
                unlink("../" . $old_image);
            }
        } else {
            echo "<script>alert('Failed to upload image.'); history.back();</script>";
            exit;
        }
    }

    // Update resident's image path in the database
    $database = new Database();
    $db = $database->connect();
    $query = "UPDATE tbl_resident SET image_path = :image_path WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':image_path', $image_path);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo "<script>alert('Resident image updated successfully.'); window.location='../views/view_resident.php?id=$id';</script>";
    } else {
        echo "<script>alert('Failed to update resident image.'); history.back();</script>";
    }
}
?>
