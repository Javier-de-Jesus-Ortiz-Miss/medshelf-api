<?php

namespace App\Models;

use Database\Factories\ActiveCompoundModelFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $public_id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static ActiveCompoundModelFactory factory($count = null, $state = [])
 * @method static Builder<static>|ActiveCompoundModel newModelQuery()
 * @method static Builder<static>|ActiveCompoundModel newQuery()
 * @method static Builder<static>|ActiveCompoundModel query()
 * @method static Builder<static>|ActiveCompoundModel whereCreatedAt($value)
 * @method static Builder<static>|ActiveCompoundModel whereDeletedAt($value)
 * @method static Builder<static>|ActiveCompoundModel whereId($value)
 * @method static Builder<static>|ActiveCompoundModel whereName($value)
 * @method static Builder<static>|ActiveCompoundModel wherePublicId($value)
 * @method static Builder<static>|ActiveCompoundModel whereUpdatedAt($value)
 * @mixin Eloquent
 */
#[Table('active_compounds')]
#[Fillable(['name'])]
class ActiveCompoundModel extends Model
{
    /** @use HasFactory<ActiveCompoundModelFactory> */
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
