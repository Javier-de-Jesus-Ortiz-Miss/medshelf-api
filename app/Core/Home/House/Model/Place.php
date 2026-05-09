<?php

namespace App\Core\Home\House\Model;

use App\Core\Shared\Domain\Utils;
use Carbon\Carbon;

final class Place
{
    private function __construct(
        protected string $id,
        protected string $houseId,
        protected string $name,
        protected Carbon $createdAt,
    )
    {
    }

    public static function load(string $id, string $houseId, string $name, Carbon $createdAt): Place
    {
        return new self($id, $houseId, $name, $createdAt);
    }

    public static function create(string $houseId, string $name): Place
    {
        return new self(Utils::generateUUIDV4(), $houseId, $name, Carbon::now());
    }

    public function getHouseId(): string
    {
        return $this->houseId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getCreatedAt(): Carbon
    {
        return $this->createdAt;
    }

    public function changeName(string $name): void
    {
        if ($name !== $this->name) {
            $this->name = $name;
        }
    }
}

