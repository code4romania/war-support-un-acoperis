<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class HelpRequestDependant
 * @package App
 *
 * @property int $id
 * @property int|null $help_request_id
 * @property string|null $full_name
 * @property int $age
 * @property string|null $mentions
 * @property DateTime|null $created_at
 * @property DateTime|null $updated_at
 */

class HelpRequestDependant extends Model
{
   protected $table="help_request_dependants";

    /**
     * @return BelongsTo
     */
    public function helpRequest()
    {
        return $this->belongsTo(HelpRequest::class, "help_request_id");
    }

}
