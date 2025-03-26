<?php 

namespace App\Entities;

class Post {
    public int $id;
    public string $user;
    public string $content;
    public string $timestamp;

    public function __construct(array $data) {
        $this->id = $data['id'] ?? 0;
        $this->user = $data['user'];
        $this->content = $data['content'];
        $this->timestamp = $data['timestamp'] ?? date('Y-m-d H:i:s');
    }
}