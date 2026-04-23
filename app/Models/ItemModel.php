<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemModel extends Model
{
    protected $fillable = [
        'public_id',
        'product_id',
        'storage_id',
        'total_quantity',
        'available_quantity',
        'expiration_date',
    ];

    protected $casts = [
        'expiration_date' => 'datetime',
        'total_quantity' => 'integer',
        'available_quantity' => 'integer',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(ProductModel::class);
    }

    public function storage(): BelongsTo
    {
        return $this->belongsTo(StorageModel::class);
    }
}
