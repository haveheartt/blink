<?php 

namespace App\Controllers;
use App\UseCases\GetFeedUseCase;

class FeedController {
    private GetFeedUseCase $feedUseCase;

    public function __construct() {
        $this->feedUseCase = new GetFeedUseCase();
    }

    public function getFeed() {
        $posts = $this->feedUseCase->execute();
        echo json_encode($posts);
    }
}