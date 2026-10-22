<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Throwable;

class AuthService
{
    public function register(array $data): User
    {
        try {
            $user = new User();

            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = Hash::make($data['password']);
            $user->role = 'user';

            $user->save();

            Log::info('User registered successfully', [
                'user_id' => $user->id,
            ]);

            return $user;

        } catch (Throwable $e) {
            Log::error('User registration failed', [
                'exception' => $e,
            ]);

            throw $e;
        }
    }

   public function login(array $data): array
{
    try {
        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The email or password is incorrect.'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        Log::info('User logged in successfully', [
            'user_id' => $user->id,
        ]);

        return [
            'user' => $user,
            'token' => $token,
        ];

    } catch (ValidationException $e) {
        throw $e;

    } catch (Throwable $e) {
        Log::error('Unexpected login error', [
            'exception' => $e,
        ]);

        throw $e;
    }
}

    public function getAllUsers()
    {
        try {
            return User::all();

        } catch (Throwable $e) {
            Log::error('Failed to retrieve users', [
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}