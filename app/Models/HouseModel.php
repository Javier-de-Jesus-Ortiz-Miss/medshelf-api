<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HouseModel extends Model
{
    protected $fillable = ['public_id', 'owner_id', 'name'];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function places(): HasMany
    {
        return $this->hasMany(PlaceModel::class);
    }
}
