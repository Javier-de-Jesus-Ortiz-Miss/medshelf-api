<?php

namespace App\Core\Storage\Application\Service;

use App\Core\Storage\Application\Dto\Request\CreateStorageUnitRequest;
use App\Core\Storage\Application\Dto\Response\StorageUnitResponse;
use App\Core\Storage\Application\Mapping\StorageUnitMapper;
use App\Core\Storage\Application\Port\CreateStorageUnit;
use App\Core\Storage\Model\StorageUnit;
use App\Core\Storage\Model\StorageUnitRepository;

final readonly class CreateStorageUnitService implements CreateStorageUnit
{
    public function __construct(
        private StorageUnitRepository $repository
    )
    {
    }

    public function execute(CreateStorageUnitRequest $request): StorageUnitResponse
    {
        $storageUnit = StorageUnit::create(
            placeId: $request->placeId,
            name: $request->name
        );
        $this->repository->save($storageUnit);
        return StorageUnitMapper::toStorageUnitResponse($storageUnit);
    }
}
