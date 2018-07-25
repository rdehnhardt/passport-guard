<?php

namespace Rdehnhardt\Passport;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Guard;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        Auth::provider('passport', function ($app) {
            return new PassportUserProvider($app->make(User::class));
        });

        Auth::extend('passport', function ($app, $name, array $config) {
            return new PassportGuard(Auth::createUserProvider($config['provider']), $app->make('request'));
        });
    }
}
