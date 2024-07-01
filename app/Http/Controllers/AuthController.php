<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    //
    public function register()
    {
        $validatedAttr = request()->validate([
            'first_name' => 'min:3',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'phone_number' => 'unique:users,phone_number|min:7|max:15',
            'dob' => 'required|date',
            'gender' => 'required|in:male,female,others',
            'address' => 'required|string|max:255',
            'role' => 'in:admin,user',
        ]);

        User::create($validatedAttr);
        return response()->json([
            "status" => true,
            'message' => 'User created successfully',
            'data' => "will figure out later"
        ], 201);
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }

        $user = auth()->user(); // Get the authenticated user who logged in

        return response()->json([
            "status" => true,
            "message" => "User logged in successfully",
            "data" => [
                "token" => $token,
                "user" => [
                    "first_name" => $user->first_name,
                    "last_name" => $user->last_name,
                    "email" => $user->email,
                    "role" => $user->role, // Include the user's role

                ],
            ]
        ], 200);
    }
    //logout
    public function logout(Request $request)
    {
        try {
            JWTAuth::invalidate(JWTAuth::parseToken());
            return response()->json(['message' => 'User logged out successfully'], 200);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Failed to logout, please try again'], 500);
        }
    }
}
