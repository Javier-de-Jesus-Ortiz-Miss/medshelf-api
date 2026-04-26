<?php

namespace App\Core\Item\Application\Port;

use App\Core\Item\Application\Dto\Response\ConsumptionViewResponse;
use App\Core\Shared\Domain\CursorRequest;
use App\Core\Shared\Domain\CursorResponse;
use App\Core\Shared\Domain\OffsetRequest;
use App\Core\Shared\Domain\OffsetResponse;

interface ConsumptionReadRepository
{
    public function findById(string $id): ConsumptionViewResponse;

    public function listByItemIdByOffset(string $itemId, OffsetRequest $request): OffsetResponse;

    public function listByItemIdByCursor(string $itemId, CursorRequest $request): CursorResponse;
}
