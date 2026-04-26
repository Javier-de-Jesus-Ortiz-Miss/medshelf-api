<?php

namespace App\Core\Storage\Application\UseCase;

use App\Core\Storage\Model\StorageUnitRepository;

final readonly class DeleteStorageUnit
{
    public function __construct(
        private StorageUnitRepository $repository
    )
    {
    }

    public function execute(string $storageUnitId): void
    {
        $this->repository->deleteById($storageUnitId);
    }
}

