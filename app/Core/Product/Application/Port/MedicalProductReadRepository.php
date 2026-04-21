<?php

namespace App\Core\Product\Application\Port;

use App\Core\Product\Application\Dto\Response\MedicalProductResponse;
use App\Core\Shared\Domain\CursorRequest;
use App\Core\Shared\Domain\CursorResponse;
use App\Core\Shared\Domain\OffsetRequest;
use App\Core\Shared\Domain\OffsetResponse;

interface MedicalProductReadRepository
{
    function findById(string $id): ?MedicalProductResponse;

    function listByOffset(OffsetRequest $request): OffsetResponse;

    function listByCursor(CursorRequest $request): CursorResponse;
}

