<?php 

namespace App\UseCases;
use App\Persistence\UserDAO;
use Firebase\JWT\JWT;

class SignInUseCase {
    private UserDAO $userDAO;
    private \PDO $db;

    public function __construct() {
        $this->userDAO = new UserDAO();
        $this->db = \App\Config\Database::getConnection();
    }

    public function execute(string $email, string $password): string {
        $user = $this->userDAO->findByEmail($email);
        if (empty($user)) {
            throw new \Exception('User not found');
        }

        $isPasswordValid = password_verify($password, $user['password']);
        if (!$isPasswordValid) {
            throw new \Exception('Invalid password');
        }

        $payload = [
            'sub' => $user['id'],
            'iat' => time(),
            'nbf' => time(),
            'exp' => time() + (60 * 60)
        ];

        $jwtSecret = $_ENV['JWT_SECRET'] ?? '';
        if (!$jwtSecret) {
            throw new \Exception('JWT secret not configured');
        }

        $accessToken = JWT::encode($payload, $jwtSecret, 'HS256');        
        return $accessToken;
    }
}