<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FacilityType
 * @package App
 *
 * @property int $id
 * @property string $type
 * @property string $name
 * @property DateTime|null $created_at
 * @property DateTime|null $updated_at
 */
class FacilityType extends Model
{
    const TYPE_GENERAL = 'general';
    const TYPE_SPECIAL = 'special';
    const TYPE_OTHER = 'other';
}
