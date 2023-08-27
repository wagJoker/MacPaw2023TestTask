<?php
class UserModel {
    private $conn;

    public function __construct() {
        $servername = "localhost";
        $username = "username";
        $password = "password";
        $dbname = "your_database";

        try {
            $this->conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function registerUser($username, $token) {
        try {
            $stmt = $this->conn->prepare("INSERT INTO users (username, token) VALUES (:username, :token)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':token', $token);
            return $stmt->execute();
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}