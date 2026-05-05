<?php

namespace App\Core\Shared\Domain;

enum Mass: string implements Unit
{
    case G = 'g';
    case MG = 'mg';

    public function convert(float $value): float
    {
        return match ($this) {
            self::G => $value,
            self::MG => $value / 1000,
        };
    }

    public function symbol(): string
    {
        return $this->value;
    }
}
