<?php

namespace App\core\inventory\model;

final readonly class Medicine
{
    private function __construct(
        public string $brandName
    )
    {
    }

    public static function create(string $brandName): Medicine
    {
        return new self($brandName);
    }
}
