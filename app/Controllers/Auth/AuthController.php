<?php

namespace App\Controllers\Auth;

use App\Repositories\UserRepository;
use Core\Application;
use Core\Request;
use Core\Response;

class AuthController
{
    protected UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function login(Request $request): bool|string
    {
        $data = $request->getData();

        $user = $this->userRepository->findBy('email', $data['email']);

        $response = new Response();
        if(!$user){
            return $response->json(['login' => false, 'message' => 'User not found']);
        }

        if(!password_verify($data['password'], $user['password'])){
            return $response->json(['login' => false, 'message' => 'Password is incorrect']);
        }

        return Application::$app->login($user);
    }

    public function register(Request $request)
    {
        $data = $request->getData();

        $response = new Response();
        if ($this->userRepository->findBy('email', $data['email'])) {
            return $response->json(['register' => false, 'message' => 'Email already exists']);
        }

        $user = $this->userRepository->create($data);
        Application::$app->login($user);

        return $response->json(['success' => true, 'message' => 'User registered successfully']);
    }

    public function logout(): false|string
    {
         Application::$app->logout();

        return Application::$app->response->json(['success' => true]);
    }
}