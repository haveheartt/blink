<?php 

namespace App\UseCases;
use App\Persistence\PostDAO;
// use Thrift\SocialServiceClient;

class GetFeedUseCase {
    private UserDAO $userDAO;
    // private SocialServiceClient $thriftClient;

    public function __construct() {
        $this->userDAO = new UserDAO();
        // $this->thriftClient = new SocialServiceClient(/* Thrift config */);
    }

    public function execute(string $email): array {
        $posts = $this->userDAO->findByEmail($email);
        // return $this->thriftClient->sortFeed($posts);
    }
}