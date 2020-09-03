<?php

namespace App\Providers\TwillExtended;

use App\User as BaseUser;
use A17\Twill\Models\Behaviors\HasMedias;
use Illuminate\Database\Eloquent\SoftDeletes;
use A17\Twill\Models\Behaviors\IsTranslatable;

class User extends BaseUser
{
    use SoftDeletes;
    use HasMedias;
    use IsTranslatable;

    /**
     * @return bool
     */
    public function isPublished(): bool
    {
        if (! $this->isAdministrator()) {
            return false;
        }

        $this->setAttribute('role_value', 'Publisher');
        return true;
    }

    /**
     * This disables CMS Users menu for all users
     *
     * @return bool
     */
    public function isSuperAdmin(): bool
    {
        return false;
    }

    /**
     * @return string
     */
    public function getAttributeRole(): string
    {
        return 'Publisher';
    }

    /**
     * @return bool
     */
    public function getPublishedAttribute()
    {
        return $this->isPublished();
    }
}
