<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ResourceType
 * @package App
 *
 * @property int $id
 * @property string $name
 * @property boolean $options
 * @property DateTime|null $created_at
 * @property DateTime|null $updated_at
 */
class ResourceType extends Model
{
    const OPTION_NONE = 0;
    const OPTION_MESSAGE = 1;
    const OPTION_ALERT = 2;
}
