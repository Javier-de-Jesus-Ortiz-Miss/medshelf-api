<?php

namespace App\Core\Catalog\Product\Model\ValueObject;

use InvalidArgumentException;

enum ConsumptionType: string
{
    case DISCRETE = 'Discrete';
    case CONTINUOUS = 'Continuous';
    case APPLICABLE = 'Applicable';

    public static function fromString(string $value): self
    {
        return match (strtolower($value)) {
            'discrete' => self::DISCRETE,
            'continuous' => self::CONTINUOUS,
            'applicable' => self::APPLICABLE,
            default => throw new InvalidArgumentException(sprintf('Invalid consumption type: %s', $value)),
        };
    }
}