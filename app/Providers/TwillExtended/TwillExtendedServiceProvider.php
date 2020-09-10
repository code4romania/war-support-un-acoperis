<?php

namespace App\Providers\TwillExtended;

use \A17\Twill\Http\Controllers\Admin\UserController as BaseUserController;
use A17\Twill\Repositories\UserRepository as BaseUserRepository;
use Illuminate\Support\ServiceProvider;

class TwillExtendedServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \A17\Twill\Http\Controllers\Admin\LoginController::class,
            \App\Providers\TwillExtended\LoginController::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        config(['auth.providers.twill_users' => [
            'driver' => 'eloquent',
            'model' => \App\Providers\TwillExtended\User::class,
        ]]);
    }
}
