<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Accommodation
 *
 * @package App
 *
 * @property string $review
 * @property int    $rating
 */
class AccommodationReview extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'accommodation_reviews';

    protected $fillable = ['review', 'rating', 'user_id', 'accommodation_id'];

    public function accommodation(): BelongsTo
    {
        return $this->belongsTo(Accommodation::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
