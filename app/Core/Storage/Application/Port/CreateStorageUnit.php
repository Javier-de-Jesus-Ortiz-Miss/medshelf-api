<?php

namespace App\Core\Storage\Application\Port;

use App\Core\Storage\Application\Dto\Request\CreateStorageUnitRequest;
use App\Core\Storage\Application\Dto\Response\StorageUnitResponse;

interface CreateStorageUnit
{
    public function execute(CreateStorageUnitRequest $request): StorageUnitResponse;
}
