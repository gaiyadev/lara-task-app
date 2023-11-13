<?php

namespace App\Repositories;

use App\Events\ForgotPassword;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ForgotPasswordRequest;
use Illuminate\Http\Request;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use App\Traits\ResponseAPI;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    use ResponseAPI;

    /**
     * Summary of forgotPassword
     * @param \App\Http\Requests\ForgotPasswordRequest $request
     * @return void
     */
    public function forgotPassword(ForgotPasswordRequest $request)
    {
        try {
            $findUser = User::where('email', $request->email)->first();

            if (!$findUser) {
                return $this->error("Email address not found.", 404);
            }

            if ($findUser->is_verified == 0) {
                return $this->error("Account not yet verified.", 403);
            }

            $findUser->verification_token = Str::random(60);
            $findUser->save();

            Event::dispatch(new ForgotPassword($findUser));

            return $this->success("link sent sucessfully", $findUser->only('id', 'email'), 200);

        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    /**
     * Summary of resetPassword
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function resetPassword(Request $request)
    {
        $userId = $request->query('id');
        $token = $request->query('token');
        $password = $request->input('password');

        try {
            $user = User::find($userId);

            if (!$user) {
                return $this->error('Invalid or expired token', 403);
            }

            if ($user->verification_token === $token) {
                $user->password = $password;
                $user->verification_token = null;
                $user->save();

                return $this->success("Password reset successful", $user->only('id', 'email'), 201);
            }

            return $this->error('Invalid or expired token', 403);

        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }
    /**
     * Summary of show
     * @param mixed $id
     * @return \Illuminate\Http\JsonResponse|mixed
     */

    public function show($id)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return $this->error('User not foun4', 403);
            }
            return $this->success("Fetched successful", $user, 200);

        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }
    /**
     * Summary of destroy
     * @param mixed $id
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function destroy($id)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return $this->error('User not found', 404);
            }

            $user->delete();

            return $this->success("deleted successful", $user->only('id', 'email'), 200);

        } catch (\Exception $e) {

            return $this->error($e->getMessage(), 500);

        }
    }

    /**
     * Summary of changePassword
     * @param \App\Http\Requests\ChangePasswordRequest $request
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function changePassword(ChangePasswordRequest $request)
    {
        try {
            $user = Auth::user();

            if (!Hash::check($request->password, $user->password)) {

                return $this->error('Invalid current password', 403);
            }

            $user->password = $request->new_password;
            $user->save();

            // Revoke all of the user's tokens (log them out)
            $user->tokens()->delete();

            return $this->success("Password changed successfully", $user->only('id', 'email'), 201);

        } catch (\Exception $e) {

            return $this->error($e->getMessage(), 500);
        }
    }

}

?>