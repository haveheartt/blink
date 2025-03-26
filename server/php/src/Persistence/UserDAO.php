<?php

namespace App\Persistence;
use App\Entities\Post;
use App\Config\Database;

class UserDAO {
    private \PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function findAll(): array {
        $result = $this->db->query("SELECT * FROM posts ORDER BY timestamp DESC");
        return array_map(fn($row) => new Post($row), $result->fetch_all(MYSQLI_ASSOC));
    }

    public function save(array $data) {
        $stmt = $this->db->prepare("INSERT INTO posts (user, content, timestamp) VALUES (?, ?, NOW())");
        $stmt->bind_param('ss', $data['user'], $data['content']);
        $stmt->execute();
    }
}