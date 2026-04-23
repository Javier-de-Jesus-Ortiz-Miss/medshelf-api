<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PlaceModel extends Model
{
    protected $fillable = ['public_id', 'house_id', 'name'];

    public function house(): BelongsTo
    {
        return $this->belongsTo(HouseModel::class);
    }

    public function storages(): HasMany
    {
        return $this->hasMany(StorageModel::class);
    }
}
