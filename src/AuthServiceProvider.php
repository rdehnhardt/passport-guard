<?php

namespace Rdehnhardt\Passport;

use Illuminate\Auth\PassportUserProvider;
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
        Auth::extend('passport', function ($app) {

            return new \Rdehnhardt\Passport\PassportUserProvider();
        });
    }
}
