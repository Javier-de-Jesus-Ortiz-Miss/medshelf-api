<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $public_id
 * @property int $item_id
 * @property int $amount
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read \App\Models\ItemModel $item
 * @method static Builder<static>|ConsumptionModel newModelQuery()
 * @method static Builder<static>|ConsumptionModel newQuery()
 * @method static Builder<static>|ConsumptionModel query()
 * @method static Builder<static>|ConsumptionModel whereAmount($value)
 * @method static Builder<static>|ConsumptionModel whereCreatedAt($value)
 * @method static Builder<static>|ConsumptionModel whereId($value)
 * @method static Builder<static>|ConsumptionModel whereItemId($value)
 * @method static Builder<static>|ConsumptionModel wherePublicId($value)
 * @method static Builder<static>|ConsumptionModel whereUpdatedAt($value)
 * @mixin Eloquent
 */
#[Table('consumptions')]
#[Fillable(['public_id', 'item_id', 'amount', 'consumed_at'])]
class ConsumptionModel extends Model
{
    public function item(): BelongsTo
    {
        return $this->belongsTo(ItemModel::class, 'item_id');
    }

    protected function casts(): array
    {
        return [
            'amount' => 'integer',
            'consumed_at' => 'datetime',
        ];
    }
}
