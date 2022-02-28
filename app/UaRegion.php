<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UaRegion extends Model
{
    protected $table="ua_regions";
    protected $fillable = ['id', 'country', 'region', 'region_en', 'region_ru', 'region_uk'];
    public $timestamps = true;

    /**
     * @return HasMany
     */
    public function cities()
    {
        return $this->hasMany(UaCity::class, 'region', 'region');
    }

}
