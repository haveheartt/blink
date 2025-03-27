<?php 

namespace App\Controllers;
use App\UseCases\GetFeedUseCase;

class FeedController {
    private GetFeedUseCase $feedUseCase;

    public function __construct() {
        $this->feedUseCase = new GetFeedUseCase();
    }

    public function getFeed(): string {
        $posts = $this->feedUseCase->execute();
        return json_encode($posts);
    }
}