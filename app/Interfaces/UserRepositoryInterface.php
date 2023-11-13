<?php

namespace App\Interfaces;

use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;

interface UserRepositoryInterface {
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

}
?>