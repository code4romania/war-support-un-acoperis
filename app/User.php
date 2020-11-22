<?php

namespace App;

use App\Notifications\UserCreatedMessage;
use DateTime;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Contracts\Auditable;
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
 * @property int|null $phone_country_id
 * @property string|null $phone_number
 * @property ?DateTime $approved_at
 */
class User extends Authenticatable implements Auditable
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    public const ROLE_ADMINISTRATOR = 'administrator';
    public const ROLE_HOST = 'host';

    /**
     * Attributes to exclude from the Audit.
     *
     * @var array
     */
    protected $auditExclude = [
        'password',
        'remember_token'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'email_verified_at', 'country_id', 'city', 'address', 'phone_number', 'approved_at'
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
        return $this->hasRole(self::ROLE_ADMINISTRATOR) && $this->approved_at;
    }

    /**
     * @return bool
     */
    public function isHost(): bool
    {
        return $this->hasRole(self::ROLE_HOST) && $this->approved_at;
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

    /**
     * @return HasOne
     */
    public function loginSecurity()
    {
        return $this->hasOne('App\LoginSecurity');
    }

    /**
     * @return bool
     */
    public function has2faActivated(): bool
    {
        if (! is_null($this->loginSecurity) && $this->loginSecurity->google2fa_enable === 1) {
            return true;
        }

        return false;
    }

    public function phoneCountry()
    {
        return $this->belongsTo(Country::class, 'phone_country_id', 'id');
    }
}
