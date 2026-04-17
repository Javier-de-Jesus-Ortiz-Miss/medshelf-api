<?php

namespace App\Core\Storage\Application\Service;

use App\Core\Storage\Application\Dto\Request\CreateStorageUnitRequest;
use App\Core\Storage\Application\Dto\Response\StorageUnitResponse;
use App\Core\Storage\Application\Mapping\StorageUnitMapper;
use App\Core\Storage\Application\Port\CreateStorageUnit;
use App\Core\Storage\Model\StorageRepository;
use App\Core\Storage\Model\StorageUnit;

final readonly class CreateStorageUnitService implements CreateStorageUnit
{
    public function __construct(
        private StorageRepository $repository
    )
    {
    }

    public function execute(CreateStorageUnitRequest $request): StorageUnitResponse
    {
        $inventory = StorageUnit::create(
            houseId: $request->ownerId,
            name: $request->name
        );
        $this->repository->save($inventory);
        return StorageUnitMapper::toStorageUnitResponse($inventory);
    }
}
