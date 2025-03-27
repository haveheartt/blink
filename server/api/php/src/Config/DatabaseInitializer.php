<?php

namespace App\Config;
use App\Config\Database;

class DatabaseInitializer {
    private \PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function initialize() {
        try {
            $this->db->exec("
                CREATE TABLE IF NOT EXISTS users (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    name VARCHAR(100) NOT NULL,
                    email VARCHAR(255) NOT NULL UNIQUE,
                    password VARCHAR(255) NOT NULL
                )
            ");

            $this->db->exec("
                CREATE TABLE IF NOT EXISTS posts (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    user INT NOT NULL,
                    content TEXT NOT NULL,
                    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
                    FOREIGN KEY (user) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
                )
            ");

            echo "Database tables initialized successfully\n";
        } catch (\PDOException $e) {
            throw new \RuntimeException('Failed to initialize database tables: ' . $e->getMessage());
        }
    }
}