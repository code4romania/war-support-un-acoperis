<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class HelpType
 * @package App
 *
 * @property int $id
 * @property string $name
 * @property DateTime|null $created_at
 * @property DateTime|null $updated_at
 */
class HelpType extends Model
{
    const TYPE_SMS = 5;
    const TYPE_ACCOMMODATION = 6;
    const TYPE_OTHER_NEEDS = 8;
}
