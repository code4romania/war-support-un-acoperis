<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class User
 * @package App
 */
class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    public const ROLE_ADMINISTRATOR = 'administrator';
    public const ROLE_LANDLORD = 'landlord';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return bool
     */
    public function isAdministrator(): bool
    {
        return $this->hasRole(self::ROLE_ADMINISTRATOR);
    }

    /**
     * @return bool
     */
    public function isLandlord(): bool
    {
        return $this->hasRole(self::ROLE_LANDLORD);
    }
}
