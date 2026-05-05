<?php

namespace App\Models;

use Database\Factories\ProductCompoundModelFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $active_compound_id
 * @property int $product_id
 * @property float $concentration_value
 * @property string $concentration_unit
 * @property float $base_amount
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read ActiveCompoundModel $activeCompound
 * @property-read ProductModel $product
 * @method static ProductCompoundModelFactory factory($count = null, $state = [])
 * @method static Builder<static>|ProductCompoundModel newModelQuery()
 * @method static Builder<static>|ProductCompoundModel newQuery()
 * @method static Builder<static>|ProductCompoundModel query()
 * @method static Builder<static>|ProductCompoundModel whereActiveCompoundId($value)
 * @method static Builder<static>|ProductCompoundModel whereBaseAmount($value)
 * @method static Builder<static>|ProductCompoundModel whereConcentrationUnit($value)
 * @method static Builder<static>|ProductCompoundModel whereConcentrationValue($value)
 * @method static Builder<static>|ProductCompoundModel whereCreatedAt($value)
 * @method static Builder<static>|ProductCompoundModel whereDeletedAt($value)
 * @method static Builder<static>|ProductCompoundModel whereId($value)
 * @method static Builder<static>|ProductCompoundModel whereProductId($value)
 * @method static Builder<static>|ProductCompoundModel whereUpdatedAt($value)
 * @mixin Eloquent
 */
#[Table('product_compounds')]
#[Fillable('strength_value', 'strength_unit')]
class ProductCompoundModel extends Model
{
    /** @use HasFactory<ProductCompoundModelFactory> */
    use HasFactory;

    public function activeCompound(): BelongsTo
    {
        return $this->belongsTo(ActiveCompoundModel::class, 'active_compound_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(ProductModel::class, 'product_id');
    }

    protected function casts(): array
    {
        return [
            'strength_value' => 'float',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }
}
