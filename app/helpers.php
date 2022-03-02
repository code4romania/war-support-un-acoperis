<?php

use Illuminate\Support\Facades\Config;

if (!function_exists('formatDate')) {
    function formatDate($date): string
    {
        return $date->setTimezone(Config::get('app.frontend_timezone'))
                    ->format(Config::get('app.frontend_date_format'));
    }
}

if (!function_exists('formatDateTime')) {
    function formatDateTime($dateTime): string
    {
        return $dateTime->setTimezone(Config::get('app.frontend_timezone'))
                        ->format(Config::get('app.frontend_datetime_format'));
    }
}

if (!function_exists('handleActiveClass')) {
    function handleActiveClass(string $match): string
    {
        return Route::is($match) ? 'active' : '';
    }
}

