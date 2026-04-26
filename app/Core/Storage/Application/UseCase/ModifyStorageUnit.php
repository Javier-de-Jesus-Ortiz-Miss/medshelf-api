<?php

namespace App\Core\Storage\Application\UseCase;

use App\Core\Storage\Application\Dto\Request\ModifyStorageUnitRequest;
use App\Core\Storage\Application\Dto\Response\StorageUnitResponse;
use App\Core\Storage\Application\Mapping\StorageUnitMapper;
use App\Core\Storage\Model\StorageUnitRepository;
use InvalidArgumentException;

final readonly class ModifyStorageUnit
{
    public function __construct(
        private StorageUnitRepository $repository
    )
    {
    }

    public function execute(ModifyStorageUnitRequest $request): StorageUnitResponse
    {
        $storageUnit = $this->repository->findById($request->houseId) ??
            throw new InvalidArgumentException("Storage unit with id $request->houseId not found");
        $storageUnit->changeName($request->name);
        $this->repository->save($storageUnit);
        return StorageUnitMapper::toStorageUnitResponse($storageUnit);
    }
}
