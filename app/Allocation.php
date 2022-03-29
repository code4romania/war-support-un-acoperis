<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Allocation extends Model
{
    protected $table = 'allocations';

    protected $fillable = [
        'accommodation_id',
        'help_request_id',
        'start_date',
        'end_date',
        'number_of_guest',
        'created_at',
        'deallocated_at'
    ];


    protected $casts = [
        'start_date' => 'date:Y-m-d',
        'end_date' => 'date:Y-m-d',
    ];

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

    public function historyItem():HasOne
    {
        return $this->hasOne(AllocationHistory::class);
    }
}
