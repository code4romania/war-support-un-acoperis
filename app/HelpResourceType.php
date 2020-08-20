<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class HelpResourceType
 * @package App
 *
 * @property int $id
 * @property int $help_resource_id
 * @property int $resource_type_id
 * @property DateTime|null $created_at
 * @property DateTime|null $updated_at
 * @property DateTime|null $deleted_at
 *
 */
class HelpResourceType extends Model
{
    use SoftDeletes;

    /**
     * @return BelongsTo
     */
    public function helpresource()
    {
        return $this->belongsTo(HelpResource::class, 'help_resource_id');
    }

    /**
     * @return BelongsTo
     */
    public function resourcetype()
    {
        return $this->belongsTo(ResourceType::class, 'resource_type_id');
    }

    /**
     * @return HasMany
     */
    public function notes()
    {
        return $this
            ->hasMany(Note::class, 'entity_id')
            ->where('notes.entity_type', '=', Note::TYPE_HELP_RESOURCE);
    }
}
