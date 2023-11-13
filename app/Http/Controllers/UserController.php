<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $usersRepository;
     /**
      * Summary of __construct
      * @param \App\Interfaces\UserRepositoryInterface $usersRepository
      */

    public function __construct(UserRepositoryInterface $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    /**
     * Summary of forgotPassword
     * @param \App\Http\Requests\ForgotPasswordRequest $request
     * @return void
     */
    public function forgotPassword(ForgotPasswordRequest $request)
    {
        return $this->usersRepository->forgotPassword($request);
    }

    /**
     * Summary of resetPassword
     * @param \App\Http\Requests\ResetPasswordRequest $request
     * @return void
     */
    public function resetPassword(ResetPasswordRequest $request)
    {
        return $this->usersRepository->resetPassword($request);
    }


}
