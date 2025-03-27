<?php

namespace App\Controllers;
use App\UseCases\GetProfileUseCase;

class UserController {
    private GetProfileUseCase $getProfileUseCase;

    public function __construct() {
        $this->getProfileUseCase = new GetProfileUseCase();
    }

    public function getProfile(array $request) {
        $user = $this->getProfileUseCase->execute($request['email']);
        if (empty($user)) {
            return json_encode(['status' => 'failed', 'error' => 'User not found']);
        }

        echo json_encode([
            'status' => 'success',
            'user' => [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email']
            ]
        ]);
    }

}