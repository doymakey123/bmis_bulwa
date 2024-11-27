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
}
?>
