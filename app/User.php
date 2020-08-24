<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class User
 * @package App
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property DateTime|null $email_verified_at
 * @property string|null $password
 * @property string|null $remember_toekn
 * @property DateTime|null $created_at
 * @property DateTime|null $updated_at
 * @property int $country_id
 * @property string|null $city
 * @property string|null $address
 * @property string|null $phone_number
 */
class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    public const ROLE_ADMINISTRATOR = 'administrator';
    public const ROLE_HOST = 'host';

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
    public function isHost(): bool
    {
        return $this->hasRole(self::ROLE_HOST);
    }

    /**
     * @return HasMany
     */
    public function accommodations()
    {
        return $this->hasMany(Accommodation::class);
    }

    /**
     * @return BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
