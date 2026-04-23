<?php

namespace App\Core\Item\Application\Port;

use App\Core\Item\Application\Dto\Response\MedicalItemViewResponse;
use App\Core\Shared\Domain\CursorRequest;
use App\Core\Shared\Domain\CursorResponse;
use App\Core\Shared\Domain\OffsetRequest;
use App\Core\Shared\Domain\OffsetResponse;

interface MedicalItemReadRepository
{
    function findById(string $id): ?MedicalItemViewResponse;

    function listByPlaceIdByOffset(string $placeId, OffsetRequest $request): OffsetResponse;

    function listByPlaceIdByCursor(string $placeId, CursorRequest $request): CursorResponse;
}
