<?php

namespace App\Core\Storage\Application\Port;

use App\Core\Shared\Domain\CursorRequest;
use App\Core\Shared\Domain\CursorResponse;
use App\Core\Shared\Domain\OffsetRequest;
use App\Core\Shared\Domain\OffsetResponse;
use App\Core\Storage\Application\Dto\Response\StorageUnitResponse;

interface StorageUnitReadRepository
{
    function findById(string $id): ?StorageUnitResponse;

    function listByOffset(OffsetRequest $request): OffsetResponse;

    function listByCursor(CursorRequest $request): CursorResponse;
}

