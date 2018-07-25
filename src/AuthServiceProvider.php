<?php

namespace Rdehnhardt\Guard;

class AuthServiceProvider
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
        $this->package('rdehnhardt/passport-guard');

        Auth::extend('passport', function($app)
        {
            $passport = $app['passport'];
            $model = null;

            if (isset($app['config']['auth.model'])) {
                $model = $app['config']['auth.model'];
            }

            $sessionStore = \App::make('session.store');
            $userProvider = new PassportUserProvider($passport, $passport->getBucket($bucketName), $model, $app['hash']);

            return new Guard($userProvider, $sessionStore);
        });
    }
}
