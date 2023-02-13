<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

//use \Spiral\RoadRunner\Http\Request;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $req = $request->validated();

        $user = User::create([
            'name' => $req['name'],
            'email' => $req['email'],
            'password' => bcrypt($req['password'])
        ]);
        $token = $user->createToken('userTokens')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response($response, 201);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

//        $user = User::where('email', $req['email'])->first();
//
//        if(!Hash::check($req['password'], $user->password)){
//            return response(['message' => 'Wrong credentials'], 401);
//        }
        if (auth()->attempt($credentials)) {
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

//
//namespace App\Http\Controllers;
//
//use App\Models\User;
//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Hash;
//
////use \Spiral\RoadRunner\Http\Request;
//
//class AuthController extends Controller
//{
//    public function register(Request $request)
//    {
//        $req = $request->validate([
//            'name' => 'required|string',
//            'email' => 'required|string|unique:users,email',
//            'password' => 'required|string|confirmed'
//        ]);
//
//        $user = User::create([
//            'name' => $req['name'],
//            'email' => $req['email'],
//            'password' => bcrypt($req['password'])
//        ]);
//        $token = $user->createToken('userTokens')->plainTextToken;
//
//        $response = [
//            'user' => $user,
//            'token' => $token
//        ];
//        return response($response, 201);
//    }
//
//    public function login(Request $request)
//    {
//        $req = $request->validate([
//            'email' => 'required|string',
//            'password' => 'required|string|confirmed'
//        ]);
//
//        $user = User::where('email', $req['email'])->FirstOrFail();
//
//        if (!Hash::check($req['password'], $user->password)) {
//            return response(['message' => 'Wrong credentials'], 401);
//        }
//
//        $token = $user->createToken('userTokens')->plainTextToken;
//
//        $response = [
//            'user' => $user,
//            'token' => $token
//        ];
//        return response($response, 201);
//    }
//
//    public function logout()
//    {
//        auth()->user()->currentAccessToken()->delete();
//
//        $response = ['message' => 'log out'];
//        return response($response, 200);
//    }
//}
