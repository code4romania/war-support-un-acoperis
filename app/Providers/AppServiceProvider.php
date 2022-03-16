<?php

namespace App\Providers;

use A17\Twill\Services\Cloud\Aws;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // So that TwillExtended\User can inherit App\User roles
        Relation::morphMap([
            \App\User::class => \App\Providers\TwillExtended\User::class,
        ]);

        ResetPasswordNotification::createUrlUsing(function ($notifiable, $token) {
            return route('password.reset', [
                'locale' => $notifiable->preferredLocale(),
                'email'  => $notifiable->getEmailForPasswordReset(),
                'token'  => $token,
            ]);
        });
    }
}
