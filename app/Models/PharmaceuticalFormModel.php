<?php

namespace App\Models;

use Database\Factories\PharmaceuticalFormModelFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property string $consumption_type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static \Database\Factories\PharmaceuticalFormModelFactory factory($count = null, $state = [])
 * @method static Builder<static>|PharmaceuticalFormModel newModelQuery()
 * @method static Builder<static>|PharmaceuticalFormModel newQuery()
 * @method static Builder<static>|PharmaceuticalFormModel query()
 * @method static Builder<static>|PharmaceuticalFormModel whereConsumptionType($value)
 * @method static Builder<static>|PharmaceuticalFormModel whereCreatedAt($value)
 * @method static Builder<static>|PharmaceuticalFormModel whereDeletedAt($value)
 * @method static Builder<static>|PharmaceuticalFormModel whereId($value)
 * @method static Builder<static>|PharmaceuticalFormModel whereName($value)
 * @method static Builder<static>|PharmaceuticalFormModel whereUpdatedAt($value)
 * @mixin Eloquent
 */
#[Table('pharmaceutical_forms')]
#[Fillable(['name', 'consumption_type'])]
class PharmaceuticalFormModel extends Model
{
    /** @var HasFactory<PharmaceuticalFormModelFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }
}