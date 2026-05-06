<?php

namespace App\Core\Home\Storage\Model\Repository;

use App\Core\Home\Storage\Model\Storage;

interface StorageRepository
{
    public function save(Storage $storageUnit): void;

    public function getDefaultStorageForPlace(string $placeId, string $houseId): ?Storage;
}
