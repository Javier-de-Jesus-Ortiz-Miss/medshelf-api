<?php

namespace App\core\product\model;

readonly class Concentration
{
    public function __construct(
        public string $unit,
        public int    $value
    )
    {
    }
}
