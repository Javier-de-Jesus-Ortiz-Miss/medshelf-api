<?php

namespace App\core\inventory\model;

final readonly class Substance
{
    private function __construct(
        public string $name
    )
    {
    }

    public static function create(string $name): Substance
    {
        return new self($name);
    }
}
