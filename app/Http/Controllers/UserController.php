<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\CreateProfileRequest;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Interfaces\UserRepositoryInterface;

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

    /**
     * Summary of show
     * @param mixed $id
     * @return void
     */
    public function show($id)
    {
        return $this->usersRepository->show($id);
    }

    /**
     * Summary of destroy
     * @param mixed $id
     * @return void
     */
    public function destroy($id)
    {
        return $this->usersRepository->destroy($id);
    }
    /**
     * Summary of changePassword
     * @param \App\Http\Requests\ChangePasswordRequest $request
     * @return void
     */
    public function changePassword(ChangePasswordRequest $request)
    {
        return $this->usersRepository->changePassword($request);
    }

    /**
     * Summary of createProfile
     * @param \App\Http\Requests\CreateProfileRequest $request
     * @return void
     */
    public function createProfile(CreateProfileRequest $request)
    {
        return $this->usersRepository->createProfile($request);
    }

    /**
     * Summary of updateProfile
     * @param \App\Http\Requests\UpdateProfileRequest $request
     * @return void
     */
    public function updateProfile(UpdateProfileRequest $request)
    {
        return $this->usersRepository->updateProfile($request);
    }

    /**
     * Summary of showProfile
     * @return void
     */
    public function showProfile()
    {
        return $this->usersRepository->showProfile();
    }
    /**
     * Summary of fetchAll
     * @return void
     */
    public function fetchAll()
    {
        return $this->usersRepository->fetchAll();
    }

}
