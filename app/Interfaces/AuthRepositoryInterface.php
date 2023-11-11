<?php 

namespace App\Interfaces;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserLoginRequest;
use Illuminate\Http\Request;

interface AuthRepositoryInterface
{
    public function signIn(UserLoginRequest $request);
    public function signUp(UserRegisterRequest $request);
    public function logOut(Request $request);

}

?>