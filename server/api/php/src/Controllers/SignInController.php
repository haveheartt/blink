<?php

namespace App\Controllers;
use App\UseCases\SignInUseCase;

class SignInController {
    private SignInUseCase $signInUseCase;

    public function __construct() {
        $this->signInUseCase = new SignInUseCase();
    }

    public function handle(array $request) {
        try {
            $email = $request['email'];
            $password = $request['password'];

            $accessToken = $this->signInUseCase->execute($email, $password);
            if (empty($accessToken)) {
                throw new Exception("no access token."); 
            }

            echo json_encode($accessToken);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}