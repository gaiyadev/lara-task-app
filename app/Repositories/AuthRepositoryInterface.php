<?php 

namespace App\Repositories;

interface AuthRepositoryInterface
{
    public function signIn($email, $password);

}

?>