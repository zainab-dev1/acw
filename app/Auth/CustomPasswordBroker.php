<?php

namespace App\Auth;

use Illuminate\Auth\Passwords\DatabaseTokenRepository;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class CustomPasswordBroker extends \Illuminate\Auth\Passwords\PasswordBroker
{
    /**
     * Get the user for the given credentials.
     *
     * @param  array  $credentials
     * @return \Illuminate\Contracts\Auth\CanResetPassword|null
     */
    public function getUser(array $credentials)
    {
        $credentials = array_filter($credentials, function ($key) {
            return ! str_starts_with($key, '_');
        }, ARRAY_FILTER_USE_KEY);

        // Search by email instead of username
        $user = User::where('email', $credentials['email'] ?? null)->first();

        if ($user && $user instanceof CanResetPasswordContract) {
            return $user;
        }

        return null;
    }
}
