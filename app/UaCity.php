<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UaCity extends Model
{
    protected $table = "ua_cities";
    protected $fillable = ['id', 'country', 'region', 'capital', 'major', 'city_en', 'city_ru', 'city_uk'];
    public $timestamps = true;

    /**
     * @return BelongsTo
     */
    public function region()
    {
        return $this->belongsTo(UaRegion::class, 'region', 'region');
    }

}
