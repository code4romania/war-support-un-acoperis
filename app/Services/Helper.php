<?php

namespace App\Services;

use App\User;

class Helper
{
    public static function getProfileRouteName(): string
    {
        $user = User::with('roles')->find(\auth()->user()->id);
        $role = $user->roles[0]->name;
        $path = null;
        switch ($role) {
            case User::ROLE_ADMINISTRATOR:
                $path = 'admin';
                break;
            case User::ROLE_TRUSTED:
                $path = 'trusted';
                break;
            case User::ROLE_HOST:
                $path = 'host';
                break;
            case User::ROLE_REFUGEE:
                $path = 'refugee';
                break;
        }
        return $path ? $path . '.profile' : 'home';

    }

}
