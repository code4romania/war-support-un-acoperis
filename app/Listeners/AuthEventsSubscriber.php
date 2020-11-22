<?php

namespace App\Listeners;

use App\LoginLog;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Login;

class AuthEventsSubscriber
{
    public function handleLogin(Login $event)
    {
        LoginLog::record(
            $event->user,
            $event->user->email,
            request()->ip(),
            LoginLog::LOGIN_LOG_TYPE_SUCCESS,
        );
    }

    public function handleFailed(Failed $event)
    {
        LoginLog::record(
            $event->user,
            $event->credentials['email'],
            request()->ip(),
            LoginLog::LOGIN_LOG_TYPE_FAIL,
        );
    }

    public function subscribe($events)
    {
        $events->listen(
            'Illuminate\Auth\Events\Login',
            'App\Listeners\AuthEventsSubscriber@handleLogin'
        );

        $events->listen(
            'Illuminate\Auth\Events\Failed',
            'App\Listeners\AuthEventsSubscriber@handleFailed'
        );
    }
}
