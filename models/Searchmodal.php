<?php
class Searchmodal {
    private $conn;


    public function __construct($db) {
        $this->conn = $db;
    }


    public function fetchAll() {
        $query = "SELECT fname, mname, lname, suffix FROM tbl_resident WHERE relationship_household_head = 'Head';";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

  
    
}
?>
