<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Auth\TokenProvider as AuthTokenProvider;
use App\Auth\TokenGuard as AuthTokenGuard;
use Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Auth::provider('token_provider', function ($app, array $config) {
            return new AuthTokenProvider($app['hash'], $config['model']);
        });
        Auth::extend('user_token', function ($app, $name, array $config) {
            return new AuthTokenGuard($app['auth']->createUserProvider($config['provider']), $app['request']);
        });
    }
}
