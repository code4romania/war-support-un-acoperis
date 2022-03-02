<?php

namespace App\Providers;

use A17\Twill\Services\Cloud\Aws;
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

        if (config('twill.media_library.endpoint_type') === 's3') {
            config()->set(
                'twill.glide.source',
                app(Aws::class)->filesystemFactory(config('twill.media_library.disk'))
            );
        }
    }
}
