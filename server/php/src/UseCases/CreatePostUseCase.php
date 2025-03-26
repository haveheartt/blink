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

    public function execute(string $user, string $content, string $idempotencyKey, ?string $mediaUrl = null): bool {
        $stmt = $this->db->prepare("SELECT key FROM idempotency_keys WHERE key = ?");
        $stmt->bind_param('s', $idempotencyKey);
        $stmt->execute();
        if ($stmt->get_result()->fetch_assoc()) {
            return true; // Idempotent: already processed
        }

        $this->postDAO->save([
            'user' => $user,
            'content' => $content,
            'media_url' => $mediaUrl
        ]);

        $stmt = $this->db->prepare("INSERT INTO idempotency_keys (key, operation) VALUES (?, 'create_post')");
        $stmt->bind_param('s', $idempotencyKey);
        $stmt->execute();

        return true;
    }
}