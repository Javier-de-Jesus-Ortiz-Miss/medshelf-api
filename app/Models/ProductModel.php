<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $fillable = [
        'public_id',
        'name',
        'description',
        'presentation_type',
        'concentration_value',
        'concentration_unit',
    ];

    protected $casts = [
        'concentration_value' => 'decimal:2',
    ];
}
