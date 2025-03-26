<?php 

namespace App\UseCases;
use App\Persistence\PostDAO;
// use Thrift\SocialServiceClient;

class GetFeedUseCase {
    private PostDAO $postDAO;
    // private SocialServiceClient $thriftClient;

    public function __construct() {
        $this->postDAO = new PostDAO();
        // $this->thriftClient = new SocialServiceClient(/* Thrift config */);
    }

    public function execute(): array {
        $posts = $this->postDAO->findAll();
        // return $this->thriftClient->sortFeed($posts);
    }
}