<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthValidate;
use App\Services\AuthService;
use App\Http\Requests\AuthLoginValidate;
class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    // POST register a new user 
    public function register(AuthValidate $request)
    {
        $user = $this->authService->register(
            $request->validated()
        );

        return response()->json([
            'message' => 'User registered successfully',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
            ],
        ], 201);
    }

    //POST log in 
public function login(AuthLoginValidate $request)
{
    $result = $this->authService->login(
        $request->validated()
    );

    $user = $result['user'];

    return response()->json([
        'message' => 'Login successful',
        'user' => [
            'name' => $user->name,
        ],
        'token' => $result['token']
    ], 200);
}


//GET return all users 
public function show()
    {
        $user = $this->authService->getAllUsers();

        return response()->json($user, 200);
    }
}
   