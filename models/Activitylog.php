<?php
class Activitylog {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }


    public function fetchAll() {
        $query = "SELECT * FROM tbl_activity_log;";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function create($user_id, $user_type, $activity_type, $description) {


        $query = "INSERT INTO tbl_activity_log (user_id, user_type, activity_type, description) VALUES (:user_id, :user_type, :activity_type, :description)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':user_type', $user_type);
        $stmt->bindParam(':activity_type', $activity_type);
        $stmt->bindParam(':description', $description);

        if ($stmt->execute()) {
            return ['success' => true, 'message' => 'Activity log created successfully.'];
        }
        return ['success' => false, 'message' => 'Failed to create activity log.'];
    }

  
    
}
?>
