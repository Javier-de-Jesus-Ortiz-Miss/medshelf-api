<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property-read Collection<int, \App\Models\ItemModel> $items
 * @property-read int|null $items_count
 * @property-read \App\Models\PlaceModel|null $place
 * @method static Builder<static>|StorageModel newModelQuery()
 * @method static Builder<static>|StorageModel newQuery()
 * @method static Builder<static>|StorageModel query()
 * @mixin Eloquent
 */
#[Table('storage')]
#[Fillable(['public_id', 'place_id', 'name'])]
class StorageModel extends Model
{
    public function place(): BelongsTo
    {
        return $this->belongsTo(PlaceModel::class, 'place_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(ItemModel::class, 'item_id');
    }
}
