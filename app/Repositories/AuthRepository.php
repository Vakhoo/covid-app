<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthRepository implements AuthRepositoryInterface
{

    public function register(array $attributes = [])
    {
        $user = User::create([
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            'password' => bcrypt($attributes['password'])
        ]);

        $token = $user->createToken('userTokens')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response($response, 201);
    }

    public function login(array $attributes = [])
    {
        if (auth()->attempt($attributes)) {
            $user = Auth::user();
            $token = $user->createToken(request()->userAgent())->plainTextToken;
            $response = [
                'user' => $user,
                'token' => $token
            ];
            return response($response, 201);

        } else {
            return response(['message' => __('auth.wrong_credentials')], 401);
        }
    }

    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();

        $response = ['message' => 'log out'];
        return response($response, 200);
    }
}
