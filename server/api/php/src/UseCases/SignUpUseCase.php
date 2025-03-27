<?php 

namespace App\UseCases;
use App\Persistence\UserDAO;

class SignUpUseCase {
    private UserDAO $userDAO;
    private \PDO $db;

    public function __construct() {
        $this->userDAO = new UserDAO();
        $this->db = \App\Config\Database::getConnection();
    }

    public function execute(string $name, string $email, string $password): bool {
        $this->userDAO->signUp([
            'name' => $name,
            'email' => $email,
            'password' => $password
        ]);
        
        return true;
    }
}