<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use Illuminate\Http\Request;
use App\Interfaces\AuthRepositoryInterface;
use App\Http\Requests\UserRegisterRequest;

class AuthController extends Controller
{
    protected $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }


    /**
     * @param  \App\Http\Requests\UserRegisterRequest  $request
     */
    public function signUp(UserRegisterRequest $request)
    {
        return $this->authRepository->signUp($request);
    }

    /**
     * Handle user sign up.
     *
     * @param  \App\Http\Requests\UserLoginRequest  $request
     */
    public function signIn(UserLoginRequest $request)
    {
        return $this->authRepository->signIn($request);
    }

    /**
     * Handle user sign up.
     *
     * @param \Illuminate\Http\Request  $request
     */
    public function logOut(Request $request)
    {
        return $this->authRepository->logOut($request);
    }
}
