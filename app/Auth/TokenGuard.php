<?php

namespace App\Auth;

use Illuminate\Http\Request;
use Illuminate\Auth\TokenGuard as ParentTokenGuard;
use Illuminate\Contracts\Auth\UserProvider;
use App\Models;

class TokenGuard extends ParentTokenGuard
{
    /**
     * @var null
     */
    protected $token = NULL;

    /**
     * TokenGuard constructor.
     *
     * @param UserProvider $provider
     * @param Request $request
     * @param string $inputKey
     * @param string $storageKey
     */
    public function __construct(UserProvider $provider, Request $request, $inputKey = 'access_token', $storageKey = 'access_token')
    {
        $this->request = $request;
        $this->provider = $provider;
        $this->inputKey = $inputKey;
        $this->storageKey = $storageKey;
    }

    /**
     * Get Token
     *
     * @return AccessToken model
     */
    public function token()
    {
        if (!is_null($this->token)) {
            return $this->token;
        }
        /* */
        $accessToken = NULL;
        if ($token = $this->getTokenForRequest()) {
            $accessToken = $this->provider->retrieveByCredentials(
                [$this->storageKey => $token], $token
            );
        }
        return $this->token = $accessToken;
    }

    /**
     * Get the currently authenticated user.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function user()
    {
        // If we've already retrieved the user for the current request we can just
        // return it back immediately. We do not want to fetch the user data on
        // every call to this method because that would be tremendously slow.
        if (!is_null($this->user)) {
            return $this->user;
        }
        $token = $this->token();
        if ($token) {
            return $this->user = $token->user;
        }
        return NULL;
    }

    /**
     * Logout. Remove, forget auth token
     *
     * @return void
     */
    public function logout()
    {
        /* remote auth token */
        $this->token->delete();
    }
}
