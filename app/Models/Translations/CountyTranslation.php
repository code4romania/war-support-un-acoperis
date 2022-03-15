<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;

class CountyTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];
}
