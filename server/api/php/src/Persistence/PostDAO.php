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

    public function store(int $userId, string $content) {
        try {
            $sql = "INSERT INTO posts (
                user,
                content)
                VALUES (
                :user,
                :content)";

            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":user", $userId);
            $stmt->bindValue(":content", $content);
            $stmt->execute();
            return true;
        } catch (\PDOException $e) {
            throw new \RuntimeException('Failed to create post: ' . $e->getMessage());        
        }
    }
}