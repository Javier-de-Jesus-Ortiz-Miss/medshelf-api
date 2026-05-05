<?php

namespace App\Core\Shared\Domain;

use InvalidArgumentException;

final readonly class UnitFactory
{
    public static function create(string $name): Unit
    {
        return match ($name) {
            'g' => Mass::G,
            'mg' => Mass::MG,
            'l' => Volume::L,
            'ml' => Volume::ML,
            default => throw new InvalidArgumentException("Unsupported type: $name"),
        };
    }
}