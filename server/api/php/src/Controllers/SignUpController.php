<?php

namespace App\Controllers;
use App\UseCases\CreateUserUseCase;
use App\UseCases\GetProfileUseCase;

class UserController {
    private SignUpUseCase $signUpUseCase;

    public function __construct() {
        $this->signUpUseCase = new SignUpUseCase();
    }

    public function handle(array $request) {
        //checks

        $success = $this->signUpUseCase->execute(
            $request['name'],
            $request['email'],
            $request['password'],
        );
        echo json_encode(['status' => $success ? 'success' : 'failed']);
    }

}