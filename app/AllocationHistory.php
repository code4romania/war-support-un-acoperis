<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\Pivot;

class AllocationHistory extends Pivot
{
    protected $table = 'allocations_history';

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
        if ($this->deallocated_at) {
            return Carbon::parse($this->deallocated_at)->diffInDays(Carbon::parse($this->from));
        }

        if($this->to){
            return Carbon::parse($this->to)->diffInDays(Carbon::parse($this->from));
        }

        return today()->diffInDays(Carbon::parse($this->from));
    }
}
