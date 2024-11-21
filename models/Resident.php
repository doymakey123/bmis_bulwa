<?php
class Resident {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($name, $email, $age) {
        $query = "INSERT INTO resident (name, email, age) VALUES (:name, :email, :age)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':age', $age);
        return $stmt->execute();
    }

    public function fetchAll() {
        $query = "SELECT * FROM resident";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id, $name, $email, $age) {
        $query = "UPDATE resident SET name = :name, email = :email, age = :age WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':age', $age);
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM resident WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>
