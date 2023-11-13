<?php
namespace App\Helpers;

class UrlHelper
{
    public static function generateVerificationUrl($user, string $type = ""): string
    {
        $baseUrl = env('FRONTEND_BASE_URL', 'http://localhost');

        $urlType = ($type === 'reset') ? 'reset-password' : 'verify-email';

        return "{$baseUrl}/{$urlType}?id={$user->id}&token={$user->verification_token}";
    }

}


?>