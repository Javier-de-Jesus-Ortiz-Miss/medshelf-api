<?php

namespace App\Core\House\Model;

interface HouseRepository
{
    public function findById(string $id): ?House;

    public function findByOwnerId(string $ownerId): ?House;

    public function save(House $house): void;

    public function exists(string $id): bool;
}
