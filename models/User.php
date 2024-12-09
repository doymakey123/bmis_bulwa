<?php
class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function login($username, $password) {
        $username = htmlspecialchars(strip_tags($username)); // Sanitize input
        $query = "SELECT * FROM users WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }


    public function fetchAll() {
        $query = "SELECT * FROM users;";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);  
    }

    public function exists($email) {
        $query = "SELECT COUNT(*) FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    public function existsu($username) {
        $query = "SELECT COUNT(*) FROM users WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    public function create($email, $username, $password, $role) {

        $query = "INSERT INTO users (email, username, password, role) VALUES (:email, :username, :password, :role)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':role', $role);

        if ($stmt->execute()) {
            return ['success' => true, 'message' => 'User account created successfully.'];
        }
        return ['success' => false, 'message' => 'Failed to create user account.'];
    }


    public function updatePassword($id, $password) {
        
        $query = "UPDATE users SET password = :password WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':password', $password);
        return $stmt->execute();
    }


    public function checkCurrentPassword($id, $current_password) {
        // Sanitize input
        $current_password = htmlspecialchars(strip_tags($current_password));
    
        // Prepare query
        $query = "SELECT password FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    
        // Fetch stored password
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Verify password
        if ($user && password_verify($current_password, $user['password'])) {
            return true;
        }
    
        return false;
    }




    public function delete($id) {
        $query = "DELETE FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }





}
?>
