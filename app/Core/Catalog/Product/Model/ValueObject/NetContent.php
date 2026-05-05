<?php

namespace App\Core\Catalog\Product\Model\ValueObject;

use App\Core\Catalog\Product\Model\Exception\NetContentException;
use App\Core\Shared\Domain\Unit;

readonly class NetContent
{
    public function __construct(
        public float $value,
        public Unit  $unit,
    )
    {
        if ($this->value <= 0) {
            throw NetContentException::invalidValue();
        }
    }

    public function conversion(Unit $unit): Strength
    {
        return new Strength($unit->convert($this->value), $unit);
    }
}
