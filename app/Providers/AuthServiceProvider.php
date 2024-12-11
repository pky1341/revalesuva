<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // $this->registerPolicies();
        // if (! $this->app->routesAreCached()) {
        //     Passport::routes();
        // }
    }
}
