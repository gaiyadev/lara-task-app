<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AuthRepositoryInterface;

class AuthController extends Controller
{
    protected $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }


    /**
     * Handle user sign up.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */

public function signUp(Request $request)
{
     $fields = $request->validate([
            'email' => ['required', 'email', 'unique:users,email', 'max:255'],
            'password' => ['required', 'min:6', 'confirmed'],
            'name' => ['required', 'alpha'],
        ]);

    try {
        $credentials = $request->only('email', 'password', 'name');

        $response = $this->authRepository->signUp(
            $credentials['email'],
            $credentials['password'],
            $credentials['name']
        );

        return response([ 
            'message' => 'User registered successfully',
            'status' => 'Success',
            'data' => $response['user']],
             201);
    } catch (\Exception $e) {
        \Log::error($e);

        return response()->json([
            'message' => 'An error occurred while processing the request.',
            'status' => 'Error',
        ], 500);
    }
}


     /**
     * Handle user sign In.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
 public function signIn(Request $request)
    {
        
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $response = $this->authRepository->signIn($credentials['email'], $credentials['password']);
 return response([ 
            'message' => 'Login successfully',
            'status' => 'Success',
            'data' => $response['user']],
             200);
        // return response()->json($response);
    }
    
public function logOut(Request $request) {
    auth()->user()->tokens()->delete();
    
    return ['message' => 'logout'];
}
}
