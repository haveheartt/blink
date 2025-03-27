<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/');
$dotenv->load();

use App\Config\DatabaseInitializer;
use App\Controllers\FeedController;
use App\Controllers\PostController;
use App\Controllers\UserController;
use App\Controllers\SignInController;
use App\Controllers\SignUpController;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

try {
    (new DatabaseInitializer())->initialize();
} catch (Exception $e) {
    header('Content-Type: application/json');
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
    exit;
}

$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$requestData = $_POST;
$contentType = $_SERVER['CONTENT_TYPE'] ?? '';
if (stripos($contentType, 'application/json') !== false) {
    $rawBody = file_get_contents('php://input');
    $jsonData = json_decode($rawBody, true);
    if (json_last_error() === JSON_ERROR_NONE) {
        $requestData = $jsonData;
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid JSON']);
        exit;
    }
}

function verifyJwtToken(string $token, string $jwtSecret): object {
    try {
        // Decode the token (requires firebase/php-jwt ^6.0)
        $decoded = JWT::decode($token, new Key($jwtSecret, 'HS256'));
        return $decoded;
    } catch (\Exception $e) {
        throw new \Exception('Invalid token: ' . $e->getMessage());
    }
}

// Define protected routes
$protectedRoutes = ['/post'];

// Apply middleware to protected routes
if (in_array($path, $protectedRoutes)) {
    $headers = getallheaders();
    $authHeader = $headers['Authorization'] ?? '';
    if (!preg_match('/Bearer (.+)/', $authHeader, $matches)) {
        http_response_code(401);
        echo json_encode(['status' => 'failed', 'error' => 'Authorization header missing or invalid']);
        exit;
    }

    $token = $matches[1];
    $jwtSecret = $_ENV['JWT_SECRET'] ?? '';
    if (!$jwtSecret) {
        http_response_code(500);
        echo json_encode(['status' => 'failed', 'error' => 'JWT secret not configured']);
        exit;
    }

    try {
        $decoded = verifyJwtToken($token, $jwtSecret);
        $requestData['user_id'] = $decoded->sub; // Add user ID to request data
    } catch (\Exception $e) {
        http_response_code(401);
        echo json_encode(['status' => 'failed', 'error' => $e->getMessage()]);
        exit;
    }
}

if ($method === 'GET' && $path === '/feed') {
    (new FeedController())->getFeed();
}

if ($method === 'POST' && $path === '/post') {
    (new PostController())->createPost($requestData);
}

if ($method === 'GET' && $path === '/profile') {
    (new UserController())->getProfile($requestData);   
}

if ($method === 'POST' && $path === '/signup') {
    (new SignUpController())->handle($requestData);
}

if ($method === 'POST' && $path === '/signin') {
    (new SignInController())->handle($requestData);
}
