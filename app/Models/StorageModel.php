<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StorageModel extends Model
{
    protected $fillable = ['public_id', 'place_id', 'name'];

    public function place(): BelongsTo
    {
        return $this->belongsTo(PlaceModel::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(ItemModel::class);
    }
}
