<?php 

namespace App\Entities;

class Post {
    public int $id;
    public int $userId;
    public string $content;
    public string $timestamp;

    public function __construct(array $data) {
        $this->id = $data['id'] ?? 0;
        $this->user = (int) ($data['user'] ?? 0);
        $this->content = $data['content'];
        $this->timestamp = $data['timestamp'] ?? date('Y-m-d H:i:s');
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function setUserId() {
        return $this->userId;
    }

    public function setContent($content) {
        $this->content = $content;
    }

    public function getTimestamp() {
        return $this->timestamp;
    }

    public function setTimestamp($timestamp) {
        $this->timestamp = $timestamp;
    }

}