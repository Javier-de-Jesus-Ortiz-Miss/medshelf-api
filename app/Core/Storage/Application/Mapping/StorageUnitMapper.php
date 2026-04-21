<?php

namespace App\Core\Storage\Application\Mapping;

use App\Core\Storage\Application\Dto\Response\StorageUnitResponse;
use App\Core\Storage\Model\StorageUnit;

final class StorageUnitMapper
{
    private function __construct()
    {
    }

    public static function toStorageUnitResponse(StorageUnit $inventory): StorageUnitResponse
    {
        return new StorageUnitResponse(
            id: $inventory->getId(),
            houseId: $inventory->getHouseId(),
            name: $inventory->getName(),
            createdAt: $inventory->getCreatedAt()
        );
    }
}
