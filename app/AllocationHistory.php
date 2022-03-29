<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\Pivot;

class AllocationHistory extends Pivot
{
    protected $table = 'allocations_history';

    protected $casts = [
        'from'           => 'date:Y-m-d',
        'to'             => 'date:Y-m-d',
        'deallocated_at' => 'datetime',
    ];

    public function allocation()
    {
        return $this->belongsTo(Allocation::class);
    }

    public function refugee()
    {
        return $this->belongsTo(User::class, 'refugee_id', 'id');
    }

    public function host()
    {
        return $this->belongsTo(User::class, 'host_id', 'id');
    }

    public function accommodation()
    {
        return $this->belongsTo(Accommodation::class, 'accommodation_id', 'id');
    }

    public function helpRequest()
    {
        return $this->belongsTo(HelpRequest::class, 'help_request_id', 'id');
    }

    public function getAccommodationTimeAttribute()
    {
        if (! is_null($this->deallocated_at)) {
            return $this->deallocated_at->diffInDays($this->from) + 1;
        }

        if (! is_null($this->to)) {
            return $this->to->diffInDays($this->from) + 1;
        }

        return today()->diffInDays($this->from) + 1;
    }
}
