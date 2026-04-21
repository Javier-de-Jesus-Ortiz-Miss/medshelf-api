<?php

namespace App\Core\Storage\Application\Service;

use App\Core\Storage\Application\Port\DeleteStorageUnit;
use App\Core\Storage\Model\StorageRepository;

final readonly class DeleteStorageUnitService implements DeleteStorageUnit
{
    public function __construct(
        private StorageRepository $repository
    )
    {
    }

    public function execute(string $storageUnitId): void
    {
        $this->repository->deleteById($storageUnitId);
    }
}

