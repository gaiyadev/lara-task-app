<?php 

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Exceptions\ForbiddenException;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthRepository implements AuthRepositoryInterface
{


public function signUp($email, $password, $name)
{
    try {
        $user = User::create([
            'email' => $email,
            'name' => $name,
            'password' => bcrypt($password),
        ]);

        return ['user' => $user->only('id', 'email'),
        ];
    } catch (\Exception $e) {
        \Log::error($e);

        return [
            'status' => 'Error',
            'message' => 'An error occurred while registering the user.',
        ];
    }
}


    public function signIn($email, $password)
    {
        $credentials = compact('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // if (!$user->is_verified) {
            //     Auth::logout();
            //     throw ValidationException::withMessages([
            //          'message' => 'Your account is not verified.',
            //     ])->status(403);
            // }

            $token = $user->createToken('auth-token')->plainTextToken;

            return ['token' => $token, 'user' => $user->only('id', 'email'),];
        }

        throw ValidationException::withMessages([
            'message' => 'The provided credentials are incorrect.',
        ])->status(403);
    }
}

?>