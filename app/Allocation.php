<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Allocation extends Model
{
    protected $table = 'allocations';

    /**
     * @return BelongsTo
     */
    public function accomodation()
    {
        return $this->belongsTo(Accommodation::class);
    }

    public function helpRequest(){
        return $this->belongsTo(HelpRequest::class);
    }
}
