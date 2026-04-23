<?php

namespace App\Core\House\Model;

use App\Core\Shared\Domain\Utils;

final class Place
{
    private function __construct(
        protected string $id,
        protected string $houseId,
        protected string $name
    )
    {
    }

    public static function create(string $houseId, string $name): Place
    {
        return new self(Utils::generateUUIDV4(), $houseId, $name);
    }

    public static function load(string $id, string $houseId, string $name): Place
    {
        return new self($id, $houseId, $name);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getHouseId(): string
    {
        return $this->houseId;
    }

    public function getName(): string
    {
        return $this->name;
    }
}

