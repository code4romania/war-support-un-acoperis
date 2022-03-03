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
 * @property string|null company_name
 * @property string|null $company_tax_id
 * @property string|null $legal_representative_name
 * @property int $country_id
 * @property int $county_id
 * @property string|null $city
 * @property string|null $address
 * @property int|null $phone_country_id
 * @property string|null $phone_number
 * @property ?DateTime $approved_at
 * @property ?HasMany $helpRequest
 */
class User extends Authenticatable implements Auditable
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    public const ROLE_ADMINISTRATOR = 'administrator';
    public const ROLE_TRUSTED = 'trusted';
    public const ROLE_HOST = 'host';
    public const ROLE_REFUGEE = 'refugee';

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
        'name', 'email', 'password', 'email_verified_at', 'company_name', 'company_tax_id', 'legal_representative_name', 'country_id', 'county_id', 'city', 'address', 'phone_number', 'approved_at'
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

    public function isAuthorized($role): bool
    {
        return $this->hasRole($role) && $this->approved_at;
    }

    public function accommodations(): HasMany
    {
        return $this->hasMany(Accommodation::class);
    }

    public function helpRequest(): HasMany
    {
        return $this->hasMany(HelpRequest::class);
    }


    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function county(): BelongsTo
    {
        return $this->belongsTo(County::class);
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

    public function isAdministrator(): bool
    {
        return $this->isAuthorized(self::ROLE_ADMINISTRATOR);
    }

    public function isHost(): bool
    {
        return $this->isAuthorized(self::ROLE_HOST);
    }

    public function isTrusted(): bool
    {
        return $this->isAuthorized(self::ROLE_TRUSTED);
    }

    public function isRefugee(): bool
    {
        return $this->isAuthorized(self::ROLE_REFUGEE);
    }
}
