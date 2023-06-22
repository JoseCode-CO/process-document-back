<?php

namespace App\Repositories;

use App\Interfaces\AuthInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthRepository implements AuthInterface
{
    public function register($request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $responseCustom = [
            'name' => $user->name,
            'email' => $user->email,
        ];

        return $responseCustom;
    }

    public function login($request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|min:8',
        ]);

        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Invalid email or password'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }

        return response()->json(['token' => $token], 200);
    }

    public function logout($request)
    {
        auth()->logout();

        return response()->json(['message' => 'User successfully logged out']);
    }
}
