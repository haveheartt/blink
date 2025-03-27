<?php 

namespace App\UseCases;
use App\Persistence\PostDAO;
use Firebase\JWT\JWT;
use Utils\Bcrypt;

class SignInUseCase {
    private UserDAO $userDAO;
    private \PDO $db;

    public function __construct() {
        $this->userDAO = new UserDAO();
        $this->db = \App\Config\Database::getConnection();
    }

    public function execute(string $email, string $password): string {
        $user = $this->userDAO->findByEmail($email);

        $isPasswordValid = Password::compare($password, $user->password);

        if (!$isPasswordValid) {
            throw Exception;
        }

        $payload = [
            'sub' => $user->id,
            'iat' => 1356999524,
            'nbf' => 1357000000
        ];

        $accessToken = JWT::encode($payload, getenv('JWT_SECRET'), 'HS256');;
        
        return accessToken;
    }
}