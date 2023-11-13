<?php

namespace App\Interfaces;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\CreateProfileRequest;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\UpdateProfileRequest;

interface UserRepositoryInterface
{
    /**
     * Summary of forgotPassword
     * @param \App\Http\Requests\ForgotPasswordRequest $request
     * @return void
     */
    public function forgotPassword(ForgotPasswordRequest $request);

    /**
     * Summary of resetPassword
     * @param \App\Http\Requests\ResetPasswordRequest $request
     * @return void
     */
    public function resetPassword(ResetPasswordRequest $request);

    /**
     * Summary of show
     * @param mixed $id
     * @return void
     */
    public function show($id);

    /**
     * Summary of destroy
     * @param mixed $id
     * @return void
     */
    public function destroy($id);

    /**
     * Summary of changePassword
     * @param \App\Http\Requests\ChangePasswordRequest $request
     * @return void
     */
    /**
     * Summary of changePassword
     * @param \App\Http\Requests\ChangePasswordRequest $request
     * @return void
     */
    public function changePassword(ChangePasswordRequest $request);
     /**
      * Summary of createProfile
      * @param \App\Http\Requests\CreateProfileRequest $request
      * @return void
      */
    public function createProfile(CreateProfileRequest $request);

    /**
     * Summary of showProfile
     * @return void
     */
    public function showProfile();

    /**
     * Summary of updateProfile
     * @param \App\Http\Requests\UpdateProfileRequest $request
     * @return void
     */
    public function updateProfile(UpdateProfileRequest $request);

    /**
     * Summary of fetchAll
     * @return void
     */
    public function fetchAll();

}
?>