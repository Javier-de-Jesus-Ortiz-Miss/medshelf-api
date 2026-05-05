<?php

namespace App\Models;

use Database\Factories\ProductModelFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $public_id
 * @property string $presentation
 * @property string $name
 * @property string $consume_type
 * @property float $sales_unit_value
 * @property string $sales_unit
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Collection<int, ProductCompoundModel> $activeCompounds
 * @property-read int|null $active_compounds_count
 * @method static ProductModelFactory factory($count = null, $state = [])
 * @method static Builder<static>|ProductModel newModelQuery()
 * @method static Builder<static>|ProductModel newQuery()
 * @method static Builder<static>|ProductModel query()
 * @method static Builder<static>|ProductModel whereConsumeType($value)
 * @method static Builder<static>|ProductModel whereCreatedAt($value)
 * @method static Builder<static>|ProductModel whereDeletedAt($value)
 * @method static Builder<static>|ProductModel whereId($value)
 * @method static Builder<static>|ProductModel whereName($value)
 * @method static Builder<static>|ProductModel wherePresentation($value)
 * @method static Builder<static>|ProductModel wherePublicId($value)
 * @method static Builder<static>|ProductModel whereSalesUnit($value)
 * @method static Builder<static>|ProductModel whereSalesUnitValue($value)
 * @method static Builder<static>|ProductModel whereUpdatedAt($value)
 * @mixin Eloquent
 */
#[Table('products')]
#[Fillable([
    'public_id',
    'name',
    'net_content_value',
    'net_content_unit',
    'total_quantity',
    'pharmaceutical_form_name',
    'pharmaceutical_form_consumption_type',
    'composition_reference_amount'
])]
class ProductModel extends Model
{
    /** @use HasFactory<ProductModelFactory> */
    use HasFactory;

    public function activeCompounds(): HasMany
    {
        return $this->hasMany(ProductCompoundModel::class, 'product_id');
    }

    protected function casts(): array
    {
        return [
            'net_content_value' => 'float',
            'total_quantity' => 'integer',
            'composition_reference_amount' => 'float',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }
}
