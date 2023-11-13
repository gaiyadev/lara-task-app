<?php
namespace App\Helpers;

class UrlHelper
{
    /**
     * Summary of generateVerificationUrl
     * @param mixed $user
     * @param string $type
     * @return string
     */
    public static function generateVerificationUrl($user, string $type = ""): string
    {
        $baseUrl = env('FRONTEND_BASE_URL', 'http://localhost');

        $urlType = ($type === 'reset') ? 'reset-password' : 'verify-email';

        return "{$baseUrl}/{$urlType}?id={$user->id}&token={$user->verification_token}";
    }

}


?>