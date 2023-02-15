<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Repositories\AuthRepositoryInterface;

class AuthController extends Controller
{
    protected $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function register(RegisterRequest $request)
    {
        $req = $request->validated();
        return $this->authRepository->register($req);

    }

    public function login(LoginRequest $request)
    {
        if ($request->isMethod('get')) {
            return response('Unauthorized', 401);
        }
        $credentials = $request->validated();
        return $this->authRepository->login($credentials);

    }

    public function logout()
    {
        return $this->authRepository->logout();
    }
}
