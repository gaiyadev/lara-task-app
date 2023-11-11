<?php 

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Exceptions\ForbiddenException;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Interfaces\AuthRepositoryInterface;
use App\Traits\ResponseAPI;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserLoginRequest;
use Illuminate\Http\Request;

class AuthRepository implements AuthRepositoryInterface
{
    use ResponseAPI;


public function signUp(UserRegisterRequest $request)
{
    
    try {
        if (User::where('email', $request->email)->exists()) {
        return $this->error("Email address already taken", 409);
        }
 
        $user = User::create([
            'email' =>  $request->email,
            'name' => $request->name,
            'password' => bcrypt($request->password),
        ]);

        return $this->success("created sucessfully", $user->only('id', 'email'), 201);
    } catch (\Exception $e) {
        return $this->error($e->getMessage(), $e->getCode());
    }
}


    public function signIn(UserLoginRequest $request)
    {
    $credentials = $request->only('email', 'password');

         try {
   if (Auth::attempt($credentials)) 
   {
            $user = Auth::user();

            // if (!Auth::user()->hasVerifiedEmail()) {
            //     Auth::logout();
            // return $this->error("Email address not verified", 403);
            // }

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
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function logOut(Request $request)
     {
            try {
             auth()->user()->tokens()->delete();
            return $this->success("Logout sucessfully", null);
            } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
            }
            
        }
}

?>