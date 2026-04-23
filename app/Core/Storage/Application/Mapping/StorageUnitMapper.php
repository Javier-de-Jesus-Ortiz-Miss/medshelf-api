<?php

namespace App\Core\Storage\Application\Mapping;

use App\Core\Storage\Application\Dto\Response\StorageUnitResponse;
use App\Core\Storage\Model\StorageUnit;

final class StorageUnitMapper
{
    private function __construct()
    {
    }

    public static function toStorageUnitResponse(StorageUnit $storageUnit): StorageUnitResponse
    {
        return new StorageUnitResponse(
            id: $storageUnit->getId(),
            placeId: $storageUnit->getPlaceId(),
            name: $storageUnit->getName(),
            createdAt: $storageUnit->getCreatedAt()
        );
    }
}
