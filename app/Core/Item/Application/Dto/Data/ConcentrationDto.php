<?php

namespace App\Core\Item\Application\Dto\Data;

readonly class ConcentrationDto
{
    public function __construct(
        public int    $value,
        public string $unit
    )
    {
    }
}
