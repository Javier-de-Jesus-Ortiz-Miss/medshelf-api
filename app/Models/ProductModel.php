<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $public_id
 * @property string $name
 * @property string|null $description
 * @property string $presentation_type
 * @property float $concentration_value
 * @property string $concentration_unit
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder<static>|ProductModel newModelQuery()
 * @method static Builder<static>|ProductModel newQuery()
 * @method static Builder<static>|ProductModel query()
 * @method static Builder<static>|ProductModel whereConcentrationUnit($value)
 * @method static Builder<static>|ProductModel whereConcentrationValue($value)
 * @method static Builder<static>|ProductModel whereCreatedAt($value)
 * @method static Builder<static>|ProductModel whereDescription($value)
 * @method static Builder<static>|ProductModel whereId($value)
 * @method static Builder<static>|ProductModel whereName($value)
 * @method static Builder<static>|ProductModel wherePresentationType($value)
 * @method static Builder<static>|ProductModel wherePublicId($value)
 * @method static Builder<static>|ProductModel whereUpdatedAt($value)
 * @mixin Eloquent
 */
#[Table('products')]
#[Fillable([
    'public_id',
    'name',
    'description',
    'presentation_type',
    'concentration_value',
    'concentration_unit',
])]
class ProductModel extends Model
{
    protected function casts(): array
    {
        return [
            'concentration_value' => 'float',
        ];
    }
}
