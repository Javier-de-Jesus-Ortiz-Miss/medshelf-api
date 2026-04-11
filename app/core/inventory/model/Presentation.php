<?php

namespace App\core\inventory\model;

final readonly class Presentation
{
    private function __construct(
        public string $shape,
        public int    $totalAmount,
        public string $unit
    )
    {
    }

    public static function create(string $shape, int $totalAmount, string $unit): Presentation
    {
        return new self($shape, $totalAmount, $unit);
    }
}
