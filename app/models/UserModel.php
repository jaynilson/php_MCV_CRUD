<?php
class User
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function create($username, $password)
    {
        try {
            // Check if the username already exists
            $sql = "SELECT COUNT(*) AS count FROM users WHERE username = :username";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":username", $username);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result['count'] == 0) {
                // Hash the password
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

                // Insert the new user
                $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(":username", $username);
                $stmt->bindParam(":password", $hashedPassword);
                $stmt->execute();
                echo "User registered successfully.";
            } else {
                // Redirect before output
                header("Location: /auth/register");
                exit; // Stop further execution
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function Authentication($username, $password)
    {
        try {
            // Correct SQL syntax
            $sql = "SELECT id, password FROM users WHERE username = :username";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":username", $username);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                return $user['id'];
            } else {
                return false; // Return false if authentication fails
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}