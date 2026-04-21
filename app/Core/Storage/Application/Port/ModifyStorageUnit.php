<?php

namespace App\Core\Storage\Application\Port;


use App\Core\Storage\Application\Dto\Request\ModifyStorageUnitRequest;
use App\Core\Storage\Application\Dto\Response\StorageUnitResponse;

interface ModifyStorageUnit
{
    public function execute(ModifyStorageUnitRequest $request): StorageUnitResponse;
}
