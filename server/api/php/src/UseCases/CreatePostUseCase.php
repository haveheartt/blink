<?php 

namespace App\UseCases;
use App\Persistence\PostDAO;

class CreatePostUseCase {
    private PostDAO $postDAO;
    private \PDO $db;

    public function __construct() {
        $this->postDAO = new PostDAO();
        $this->db = \App\Config\Database::getConnection();
    }

    public function execute(string $user, string $content): bool {
        $this->postDAO->save([
            'user' => $user,
            'content' => $content,
        ]);

        return true;
    }
}