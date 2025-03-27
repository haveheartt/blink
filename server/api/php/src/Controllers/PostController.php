<?php

namespace App\Controllers;
use App\UseCases\CreatePostUseCase;

class PostController {
    private CreatePostUseCase $postUseCase;

    public function __construct() {
        $this->postUseCase = new CreatePostUseCase();
    }

    public function createPost(array $request) {
        $success = $this->postUseCase->execute(
            $request['user'],
            $request['content'],
        );
        echo json_encode(['status' => $success ? 'success' : 'failed']);
    }

    // private function uploadMedia(array $file): string {
    //     $bucketName = 'your-bucket-name';
    //     $fileName = uniqid() . '-' . basename($file['name']);
    //     $targetPath = "gs://{$bucketName}/{$fileName}";

    //     // Use Google Cloud Storage PHP client
    //     require_once __DIR__ . '/../../vendor/autoload.php';
    //     use Google\Cloud\Storage\StorageClient;

    //     $storage = new StorageClient(['keyFilePath' => '/path/to/service-account.json']);
    //     $bucket = $storage->bucket($bucketName);
    //     $bucket->upload(
    //         fopen($file['tmp_name'], 'r'),
    //         ['name' => $fileName, 'predefinedAcl' => 'publicRead']
    //     );

    //     return "https://storage.googleapis.com/{$bucketName}/{$fileName}";
    // }
}