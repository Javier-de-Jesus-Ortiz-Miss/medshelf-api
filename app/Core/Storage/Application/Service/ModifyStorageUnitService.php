<?php

namespace App\Core\Storage\Application\Service;

use App\Core\Storage\Application\Dto\Request\ModifyStorageUnitRequest;
use App\Core\Storage\Application\Dto\Response\StorageUnitResponse;
use App\Core\Storage\Application\Mapping\StorageUnitMapper;
use App\Core\Storage\Application\Port\ModifyStorageUnit;
use App\Core\Storage\Model\StorageRepository;
use InvalidArgumentException;

final readonly class ModifyStorageUnitService implements ModifyStorageUnit
{
    public function __construct(
        private StorageRepository $repository
    )
    {
    }

    public function execute(ModifyStorageUnitRequest $request): StorageUnitResponse
    {
        $inventory = $this->repository->findById($request->inventoryId) ??
            throw new InvalidArgumentException("Inventory with id $request->inventoryId not found");
        $inventory->changeName($request->name);
        $this->repository->save($inventory);
        return StorageUnitMapper::toStorageUnitResponse($inventory);
    }
}
