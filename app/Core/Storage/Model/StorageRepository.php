<?php

namespace App\Core\Storage\Model;

interface StorageRepository
{
    public function findById(string $id): ?StorageUnit;

    public function findByHouseId(string $houseId): ?StorageUnit;

    public function save(StorageUnit $storageUnit): void;

    public function deleteById(string $id): void;
}
