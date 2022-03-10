<?php

namespace App;

use Carbon\Carbon;
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
        return $this->belongsTo(Accommodation::class, 'accommodation_id', 'id');
    }

    public function helpRequest(){
        return $this->belongsTo(HelpRequest::class);
    }

    public function getDueTomorrowAttribute()
    {
        return Carbon::today()->diffInDays(Carbon::parse($this->end_date));
    }
}
