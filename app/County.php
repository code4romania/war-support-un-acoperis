<?php

namespace App;

use App\Models\Translations\CountyTranslation;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class County
 * @package App
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property DateTime|null $created_at
 * @property DateTime|null $updated_at
 */
class County extends Model implements TranslatableContract
{
    use Translatable;

    public array $translatedAttributes = [
        'name',
    ];

    public string $translationModel = CountyTranslation::class;

    /**
     * @return HasMany
     */
    public function cities()
    {
        return $this->hasMany(City::class);
    }

    /**
     * @return HasMany
     */
    public function helprequests()
    {
        return $this->hasMany(HelpRequest::class);
    }
}
