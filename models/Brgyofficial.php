<?php
class Brgyofficial {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

   

    public function exists($fname, $mname, $lname, $suffix, $year_elected) {
        $query = "SELECT COUNT(*) FROM tbl_brgy_official WHERE fname = :fname AND mname = :mname AND lname = :lname AND suffix = :suffix AND year_elected = :year_elected";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':mname', $mname);
        $stmt->bindParam(':lname', $lname);
        $stmt->bindParam(':suffix', $suffix);
        $stmt->bindParam(':year_elected', $year_elected);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    public function create($fname, $mname, $lname, $suffix, $position, $rank, $assign_area, $committee, $term, $year_elected, $status) {

        $query = "INSERT INTO tbl_brgy_official (fname, mname, lname, suffix, position, rank, assign_area, committee, term, year_elected, status) VALUES (:fname, :mname, :lname, :suffix, :position, :rank, :assign_area, :committee, :term, :year_elected, :status)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':mname', $mname);
        $stmt->bindParam(':lname', $lname);
        $stmt->bindParam(':suffix', $suffix);
        $stmt->bindParam(':rank', $rank);
        $stmt->bindParam(':position', $position);
        $stmt->bindParam(':assign_area', $assign_area);
        $stmt->bindParam(':committee', $committee);
        $stmt->bindParam(':term', $term);
        $stmt->bindParam(':year_elected', $year_elected);
        $stmt->bindParam(':status', $status);

        if ($stmt->execute()) {
            return ['success' => true, 'message' => 'Brgy. official created successfully.'];
        }
        return ['success' => false, 'message' => 'Failed to create Brgy. official.'];
    }

    public function fetchAll() {
        $query = "SELECT * FROM tbl_brgy_official WHERE status = 'Active';";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);  
    }


    public function fetchAllNotActive() {
        $query = "SELECT * FROM tbl_brgy_official WHERE status = 'Not Active';";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);  
    }


    public function update($id, $fname, $mname, $lname, $suffix, $position, $rank, $assign_area, $committee, $term, $year_elected, $status) {
        
        $query = "UPDATE tbl_brgy_official SET fname = :fname, mname = :mname, lname = :lname, suffix = :suffix, position = :position, rank = :rank, assign_area = :assign_area, committee = :committee, term = :term, year_elected = :year_elected, status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':mname', $mname);
        $stmt->bindParam(':lname', $lname);
        $stmt->bindParam(':suffix', $suffix);
        $stmt->bindParam(':position', $position);
        $stmt->bindParam(':rank', $rank);
        $stmt->bindParam(':assign_area', $assign_area);
        $stmt->bindParam(':committee', $committee);
        $stmt->bindParam(':term', $term);
        $stmt->bindParam(':year_elected', $year_elected);
        $stmt->bindParam(':status', $status);
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM tbl_brgy_official WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }



    public function individual($id) {
        $query = "SELECT * FROM tbl_brgy_official WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Bind the id parameter to the query
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Use fetch() instead of fetchAll()
    }

    
}
?>
