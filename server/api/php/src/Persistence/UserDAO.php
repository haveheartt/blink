<?php

namespace App\Persistence;
use App\Entities\Post;
use App\Config\Database;

class UserDAO {
    private \PDO $db;
    private Bcrypt $bcrypt;

    public function __construct() {
        $this->db = Database::getConnection();
        $this->bcrypt = new Bcrypt(15);
    }

    public function findByEmail(string $email): array {
        try {
            $sql = "SELECT * FROM users WHERE email = :email";
            $p_sql = Connection::getInstance()->prepare($sql);
            $p_sql->bindValue(":email", $email);
            $p_sql->execute();
            return $p_sql->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo $e->getMessage();
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

            $p_sql = $db->prepare($sql);

            $password = $this->bcrypt->hash($data['password']);

            $p_sql->bindValue(":name", $data['name']);
            $p_sql->bindValue(":email", $data['email']);
            $p_sql->bindValue(":password", $password);

            return $p_sql->execute();

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

}