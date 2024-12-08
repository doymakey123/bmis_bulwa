<?php
class Blotter {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

   

    public function exists($complainant_fname, $complainant_mname, $complainant_lname, $complainant_suffix, $respondent_fname, $respondent_mname, $respondent_lname, $respondent_suffix, $date_created) {
        $query = "SELECT COUNT(*) FROM tbl_blotter WHERE complainant_fname = :complainant_fname AND complainant_mname = :complainant_mname AND complainant_lname = :complainant_lname AND complainant_suffix = :complainant_suffix AND respondent_fname = :respondent_fname AND respondent_mname = :respondent_mname AND respondent_lname = :respondent_lname AND respondent_suffix = :respondent_suffix AND DATE_FORMAT(date_created, '%Y-%m-%d') = :date_created";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':complainant_fname', $complainant_fname);
        $stmt->bindParam(':complainant_mname', $complainant_mname);
        $stmt->bindParam(':complainant_lname', $complainant_lname);
        $stmt->bindParam(':complainant_suffix', $complainant_suffix);
        $stmt->bindParam(':respondent_fname', $respondent_fname);
        $stmt->bindParam(':respondent_mname', $respondent_mname);
        $stmt->bindParam(':respondent_lname', $respondent_lname);
        $stmt->bindParam(':respondent_suffix', $respondent_suffix);
        $stmt->bindParam(':date_created', $date_created);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    public function create($complainant_fname, $complainant_mname, $complainant_lname, $complainant_suffix, $complainant_address, $complainant_contact, $respondent_fname, $respondent_mname, $respondent_lname, $respondent_suffix, $respondent_contact, $blotter_type, $details, $status) {

        $query = "INSERT INTO tbl_blotter (complainant_fname, complainant_mname, complainant_lname, complainant_suffix, complainant_address, complainant_contact, respondent_fname, respondent_mname, respondent_lname, respondent_suffix, respondent_contact, blotter_type, details, status) VALUES (:complainant_fname, :complainant_mname, :complainant_lname, :complainant_suffix, :complainant_address, :complainant_contact, :respondent_fname, :respondent_mname, :respondent_lname, :respondent_suffix, :respondent_contact, :blotter_type, :details, :status)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':complainant_fname', $complainant_fname);
        $stmt->bindParam(':complainant_mname', $complainant_mname);
        $stmt->bindParam(':complainant_lname', $complainant_lname);
        $stmt->bindParam(':complainant_suffix', $complainant_suffix);
        $stmt->bindParam(':complainant_address', $complainant_address);
        $stmt->bindParam(':complainant_contact', $complainant_contact);
        $stmt->bindParam(':respondent_fname', $respondent_fname);
        $stmt->bindParam(':respondent_mname', $respondent_mname);
        $stmt->bindParam(':respondent_lname', $respondent_lname);
        $stmt->bindParam(':respondent_suffix', $respondent_suffix);
        $stmt->bindParam(':respondent_contact', $respondent_contact);
        $stmt->bindParam(':blotter_type', $blotter_type);
        $stmt->bindParam(':details', $details);
        $stmt->bindParam(':status', $status);

        if ($stmt->execute()) {
            return ['success' => true, 'message' => 'Blotter created successfully.'];
        }
        return ['success' => false, 'message' => 'Failed to create blotter.'];
    }

    public function fetchAll() {
        $query = "SELECT * FROM tbl_blotter;";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id, $complainant_fname, $complainant_mname, $complainant_lname, $complainant_suffix, $complainant_address, $complainant_contact, $respondent_fname, $respondent_mname, $respondent_lname, $respondent_suffix, $respondent_contact, $blotter_type, $details, $status) {
        
        $query = "UPDATE tbl_blotter SET complainant_fname = :complainant_fname, complainant_mname = :complainant_mname, complainant_lname = :complainant_lname, complainant_suffix = :complainant_suffix, complainant_address = :complainant_address, complainant_contact = :complainant_contact, respondent_fname = :respondent_fname, respondent_mname = :respondent_mname, respondent_lname = :respondent_lname, respondent_suffix = :respondent_suffix, respondent_contact = :respondent_contact, blotter_type = :blotter_type, details = :details, status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':complainant_fname', $complainant_fname);
        $stmt->bindParam(':complainant_mname', $complainant_mname);
        $stmt->bindParam(':complainant_lname', $complainant_lname);
        $stmt->bindParam(':complainant_suffix', $complainant_suffix);
        $stmt->bindParam(':complainant_address', $complainant_address);
        $stmt->bindParam(':complainant_contact', $complainant_contact);
        $stmt->bindParam(':respondent_fname', $respondent_fname);
        $stmt->bindParam(':respondent_mname', $respondent_mname);
        $stmt->bindParam(':respondent_lname', $respondent_lname);
        $stmt->bindParam(':respondent_suffix', $respondent_suffix);
        $stmt->bindParam(':respondent_contact', $respondent_contact);
        $stmt->bindParam(':blotter_type', $blotter_type);
        $stmt->bindParam(':details', $details);
        $stmt->bindParam(':status', $status);
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM tbl_blotter WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }



    public function individual($id) {
        $query = "SELECT * FROM tbl_blotter WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Bind the id parameter to the query
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Use fetch() instead of fetchAll()
    }

    
}
?>
