<?php

namespace App\core\inventory\model;

use App\core\shared\domain\Utils;
use Carbon\Carbon;

final class Inventory
{
    private function __construct(
        private string $id,
        private string $ownerId,
        private string $name,
        private Carbon $createdAt
    )
    {
    }

    public static function create(
        string $ownerId,
        string $name
    ): Inventory
    {
        return new self(Utils::generateUUIDV4(), $ownerId, $name, Carbon::now());
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getOwnerId(): string
    {
        return $this->ownerId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCreatedAt(): Carbon
    {
        return $this->createdAt;
    }

    public function changeName(?string $newName): void
    {
        if ($newName === null) {
            return;
        }
        $this->name = $newName;
    }
}
