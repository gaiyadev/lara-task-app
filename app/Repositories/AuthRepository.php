<?php

namespace App\Repositories;

use App\Events\EmailVerification;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Interfaces\AuthRepositoryInterface;
use App\Traits\ResponseAPI;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserLoginRequest;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;
use App\Http\Requests\ResendVerificationEmailRequest;
use Illuminate\Support\Facades\Event;

class AuthRepository implements AuthRepositoryInterface
{
    use ResponseAPI;

    /**
     * Summary of signUp
     * @param \App\Http\Requests\UserRegisterRequest $request
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function signUp(UserRegisterRequest $request)
    {
        try {
            DB::beginTransaction();

            if (User::where('email', $request->email)->exists()) {

                return $this->error("Email address already taken", 409);
            }

            $user = User::create([
                'email' => $request->email,
                'name' => $request->name,
                'password' => $request->password,
                'verification_token' => Str::random(60),
                'role_id' => 2,
            ]);

            DB::commit();

            Event::dispatch(new EmailVerification($user));

            return $this->success("created sucessfully", $user->only('id', 'email'), 201);

        } catch (\Exception $e) {

            DB::rollBack();

            return $this->error($e->getMessage(), 500);
        }
    }

    /**
     * Summary of verifyEmail
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function verifyEmail(Request $request)
    {
        try {
            $id = $request->query('id');
            $token = $request->query('token');

            $user = User::findOrFail($id);

            if ($user->is_verified === 1) {
                return $this->error('Account already verified', 403);
            }

            if ($user->verification_token === $token) {
                $user->is_verified = true;
                $user->verification_token = null;
                $user->email_verified_at = now();
                $user->save();

                return $this->success("Email verification successful", $user->only('id', 'email', 'is_verified'), 201);
            }

            return $this->error('Invalid or expired token', 403);

        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    /**
     * Summary of resendVerificationEmail
     * @param \App\Http\Requests\ResendVerificationEmailRequest $request
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function resendVerificationEmail(ResendVerificationEmailRequest $request)
    {
        try {
            $user = User::where('email', $request->email)->first();

            if (!$user->hasVerifiedEmail()) {
                // Generate a new verification token
                $user->verification_token = Str::random(60);
                $user->save();

                Event::dispatch(new EmailVerification($user));

                // $user->notify(new VerifyEmailNotification($verificationUrl));

                return $this->success("Verification email has been resent", $user->only('id', 'email', 'is_verified'), 200);

            }

            return $this->error('Email is already verified', 403);

        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    /**
     * Summary of signIn
     * @param \App\Http\Requests\UserLoginRequest $request
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function signIn(UserLoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (Auth::attempt($credentials)) {
                $user = Auth::user();

                if (!Auth::user()->hasVerifiedEmail()) {
                    Auth::logout();
                    return $this->error("Email address not verified", 403);
                }

                // Manually set the expiration time to 24 hours
                $tokenExpiration = now()->addHours(24);

                $token = $user->createToken('auth-token', ['expires_at' => $tokenExpiration])->plainTextToken;

                $response = [
                    'access_token' => [
                        'token' => $token,
                        'token_type' => 'Bearer',
                        'expires_at' =>
                            $tokenExpiration,
                    ],
                    'user' => $user->only('id', 'email'),
                ];

                return $this->success("Login sucessfully", $response, 200);

            }
            return $this->error("Invalid email or password", 401);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    /**
     * Summary of logOut
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function logOut(Request $request)
    {
        try {
            auth()->user()->tokens()->delete();
            return $this->success("Logout sucessfully", []);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}

?>