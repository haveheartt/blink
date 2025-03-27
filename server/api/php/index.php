<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/vendor/autoload.php';

use App\Config\DatabaseInitializer;
use App\Controllers\FeedController;
use App\Controllers\PostController;
use App\Controllers\UserController;
use App\Controllers\SignInController;
use App\Controllers\SignUpController;

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

if ($method === 'GET' && $path === '/feed') {
    (new FeedController())->getFeed();
}

if ($method === 'POST' && $path === '/post') {
    (new PostController())->createPost($_POST);
}

if ($method === 'GET' && $path === '/user') {
    (new UserController())->getProfile();   
}

if ($method === 'POST' && $path === '/signup') {
    (new SignUpController())->handle($_POST);
}

if ($method === 'POST' && $path === '/signin') {
    (new SignInController())->handle($_POST);
}
