<?php

require_once __DIR__ . '/../vendor/autoload.php';
use App\Controllers\FeedController;
use App\Controllers\PostController;

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

if ($method === 'POST' && $path === '/user') {
    (new UserController())->createUser($_POST);
}

http_response_code(404);
