<?php

namespace App\core\inventory\model;

use InvalidArgumentException;

enum ProductStatus
{
    case EXPIRED;
    case OK;
    case CONSUMED;

    public static function from(string $status): ProductStatus
    {
        return match ($status) {
            'EXPIRED' => self::EXPIRED,
            'OK' => self::OK,
            'CONSUMED' => self::CONSUMED,
            default => throw new InvalidArgumentException("Invalid product status: $status")
        };
    }
}
