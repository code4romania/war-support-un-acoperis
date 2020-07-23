<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class HelpRequestType
 * @package App
 *
 * @property int $id
 * @property int $help_request_id
 * @property int $help_type_id
 * @property string $approve_status
 * @property string|null $message
 * @property DateTime|null $created_at
 * @property DateTime|null $updated_at
 */
class HelpRequestType extends Model
{
    const APPROVE_STATUS_PENDING = 'pending';
    const APPROVE_STATUS_APPROVED = 'approved';
    const APPROVE_STATUS_DENIED = 'denied';

    /**
     * @return array
     */
    public static function approveStatusList(): array
    {
        return [
            self::APPROVE_STATUS_PENDING => __('Pending'),
            self::APPROVE_STATUS_APPROVED => __('Approved'),
            self::APPROVE_STATUS_DENIED => __('Denied')
        ];
    }

    /**
     * @return BelongsTo
     */
    public function helprequest()
    {
        return $this->belongsTo(HelpRequest::class);
    }

    /**
     * @return BelongsTo
     */
    public function helptype()
    {
        return $this->belongsTo(HelpType::class);
    }
}
