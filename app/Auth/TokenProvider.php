<?php

namespace App\Auth;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\UserProvider as LaravelUserProvider;
use App\Models;

class TokenProvider extends EloquentUserProvider implements LaravelUserProvider
{
    /**
     * Retrieve a user by the given credentials.
     *
     * @param array $credentials
     * @param null $token
     * @return Models\AccessToken|\Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials, $token = NULL)
    {
        return Models\AccessToken::checkToken($token, $credentials);
    }
}
