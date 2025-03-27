<?php

namespace App\Persistence;
use App\Entities\Post;
use App\Config\Database;

class UserDAO {
    private ?\PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function findByEmail(string $email): array {
        try {
            $sql = "SELECT * FROM users WHERE email = :email";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":email", $email);
            $stmt->execute();
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $row;
        } catch (\PDOException $e) {
            throw new \RuntimeException('Failed to fetch user by email: ' . $e->getMessage());
        }
    }

    public function signUp(array $data) {
        try {
            $sql = "INSERT INTO users (
                name,
                email,
                password)
                VALUES (
                :name,
                :email,
                :password)";

            $p_sql = $this->db->prepare($sql);

            $password = password_hash($data['password'], PASSWORD_BCRYPT, ['cost' => 12]);

            $p_sql->bindValue(":name", $data['name']);
            $p_sql->bindValue(":email", $data['email']);
            $p_sql->bindValue(":password", $password);

            return $p_sql->execute();

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

}