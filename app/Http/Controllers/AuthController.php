<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthValidate;
use App\Services\AuthService;
use App\Http\Requests\AuthLoginValidate;
use App\Traits\ApiResponse;
class AuthController extends Controller
{
    use ApiResponse;

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

         return $this->successResponse(
            $user,
            'user registered successfully'
        );
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
         return $this->successResponse(
            $user,
            'users retrived successfully'
        );
    }
}
   