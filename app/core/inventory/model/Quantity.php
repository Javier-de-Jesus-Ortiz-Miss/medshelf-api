<?php

namespace App\core\inventory\model;

final readonly class Quantity
{
    private function __construct(
        public int $number,
        public string $unit
    )
    {
    }

    public static function create(int $number, string $unit): Quantity
    {
        return new self($number, $unit);
    }
}
