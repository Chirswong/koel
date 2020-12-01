<?php

namespace App\Service;

use App\Models\User;
use Laravel\Sanctum\NewAccessToken;

class TokenManager
{
    public function createToken(User $user, array $abilities = ['*']): NewAccessToken
    {
        return $user->createToken(config('app.name'), $abilities);
    }
}
