<?php

namespace App\Services;

use App\User;

class Helper
{
    public static function getProfileRouteName(): string
    {
        $path = self::getUserType();
        return $path ? $path . '.profile' : 'home';

    }

    public static function getSidebar()
    {
        $role = self::getUserType();
        return $role ? 'layouts.partials.sidebars.'.$role : 'default';
    }

    /**
     * @return string|null
     */
    private static function getUserType(): ?string
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
        return $path;
    }

}
