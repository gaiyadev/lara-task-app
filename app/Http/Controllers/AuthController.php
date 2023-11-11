<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\AuthRepositoryInterface;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;

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

public function signUp(UserRegisterRequest $request)
{
    return $this->authRepository->signIn($request);
}

     /**
     * Handle user sign In.
     *
     * @param  \Illuminate\Http\UserLoginRequest  $request
     * @return \Illuminate\Http\Response
     */
 public function signIn(UserLoginRequest $request)
    {
     return $this->authRepository->signIn($request);
    }

public function logOut(Request $request) {
    return $this->authRepository->logOut($request);
}
}
