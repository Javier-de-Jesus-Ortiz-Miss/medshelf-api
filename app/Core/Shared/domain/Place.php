<?php

namespace App\Core\Shared\Domain;

readonly class Place
{
    private function __construct(
        public string $name
    )
    {
    }

    public static function create(string $name): Place
    {
        return new self($name);
    }

    public static function load(string $name): Place
    {
        return new self($name);
    }
}

