<?php

namespace App\Core\Storage\Model;

use App\Core\Shared\Domain\Utils;
use Carbon\Carbon;

final class StorageUnit
{
    private function __construct(
        private string $id,
        private string $houseId,
        private string $name,
        private Carbon $createdAt
    )
    {
    }

    public static function create(
        string $houseId,
        string $name
    ): StorageUnit
    {
        return new self(Utils::generateUUIDV4(), $houseId, $name, Carbon::now());
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
