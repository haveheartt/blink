<?php

namespace App\Persistence;
use App\Entities\Post;
use App\Config\Database;

class PostDAO {
    private ?\PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function findAll(): array {
        try {
            $sql = "SELECT * FROM posts ORDER BY timestamp DESC";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return array_map(fn($row) => new Post($row), $rows ?: []);
        } catch (\PDOException $e) {
            throw new \RuntimeException('Failed to fetch posts: ' . $e->getMessage());
        }
    }

    public function store(array $data) {
        try {
            $sql = "INSERT INTO posts (
                user,
                content)
                VALUES (
                :user,
                :content)";

            $p_sql = $db->prepare($sql);
            $p_sql->bindValue(":user", $data['user']);
            $p_sql->bindValue(":content", $data['content']);

            return $p_sql->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}