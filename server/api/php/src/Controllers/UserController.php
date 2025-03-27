<?php

namespace App\Controllers;
use App\UseCases\CreateUserUseCase;
use App\UseCases\GetProfileUseCase;

class UserController {
    private CreateUserUseCase $createUserUseCase;
    private GetProfileUseCase $getProfileUseCase;

    public function __construct() {
        $this->createUserUseCase = new CreateUserUseCase();
        $this->getProfileUseCase = new GetProfileUseCase();
    }

    public function getUser() {
        user = $this->getProfileUseCase->execute();
        header('Content-Type: application/json');
        echo json_encode($posts);
    }

    public function createUser(array $request) {
        //checks

        $success = $this->createUserUseCase->execute(
            $request['name'],
            $request['email'],
            $request['password'],
        );
        echo json_encode(['status' => $success ? 'success' : 'failed']);
    }

}