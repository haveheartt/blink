<?php 

namespace App\UseCases;
use App\Persistence\UserDAO;

class GetProfileUseCase {
    private UserDAO $userDAO;

    public function __construct() {
        $this->userDAO = new UserDAO();
    }

    public function execute(string $email): array {
        return $this->userDAO->findByEmail($email);
    }
}