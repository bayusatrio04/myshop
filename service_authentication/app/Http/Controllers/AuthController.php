<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use App\Http\Controllers\Exception;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string',
        ]);
    
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
    
        $user->save();
        $id = $user->id;
        $name = $user->name;
        $email = $user->email;
        $password = $request->password;
    
        return response()->json([
            'message' => 'User registered successfully',
            'id'=> $id,
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ], 201);
    }   
    

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
    
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
    
        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
    
        $user = $request->user();
        $token = $user->createToken('auth_token')->plainTextToken;

        $id = $user->id;
        $name = $user->name;
        $email = $user->email;
        $password = $request->password;
    
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'id'=> $id,
            'name' => $name,
            'email' => $email,
            'password' => $password,    
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'User logged out successfully'
        ]);
    }

    public function authenticatedUser(Request $request)
    {
        return $request->user();
    }
}