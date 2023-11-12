<?php

namespace App\Interfaces;

use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserLoginRequest;
use Illuminate\Http\Request;
use App\Http\Requests\ResendVerificationEmailRequest;

interface AuthRepositoryInterface
{

    /**
     * Summary of signIn
     * @param \App\Http\Requests\UserLoginRequest $request
     * @return void
     */
    public function signIn(UserLoginRequest $request);

    /**
     * Summary of signUp
     * @param \App\Http\Requests\UserRegisterRequest $request
     * @return void
     */
    public function signUp(UserRegisterRequest $request);

    /**
     * Summary of logOut
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function logOut(Request $request);

    /**
     * Summary of verifyEmail
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function verifyEmail(Request $request);

    /**
     * Summary of resendVerificationEmail
     * @param \App\Http\Requests\ResendVerificationEmailRequest $request
     * @return void
     */
    public function resendVerificationEmail(ResendVerificationEmailRequest $request);

}

?>