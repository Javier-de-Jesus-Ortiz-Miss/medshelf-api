<?php

namespace App\Core\Storage\Model;

interface StorageUnitRepository
{
    public function findById(string $id): ?StorageUnit;

    public function save(StorageUnit $storageUnit): void;

    public function deleteById(string $id): void;
}
