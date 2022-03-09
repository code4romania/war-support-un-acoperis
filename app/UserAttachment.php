<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class UserAttachment
 * @package App
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $identifier
 * @property string $path
 * @property int $size
 * @property string|null $extension
 * @property string|null $type
 */

class UserAttachment extends Model
{
    /**
     * @return string
     */
    public function generateUrl(): string
    {
        return route('media.attachment-content', ['docType' => get_class($this), 'docId' => $this->id, 
            'identifier' => $this->identifier, 'extension' => substr($this->extension, 1)]);
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
