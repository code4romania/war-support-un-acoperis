<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Language extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['id', 'name', 'endonym', 'abbreviation2', 'abbreviation3', 'status', 'position'];
    public $timestamps = true;

}
