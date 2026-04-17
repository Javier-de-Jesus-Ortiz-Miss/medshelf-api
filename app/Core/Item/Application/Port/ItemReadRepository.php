<?php

namespace App\Core\Item\Application\Port;

use App\Core\Item\Application\Dto\Response\ItemViewResponse;
use App\Core\Shared\Domain\PaginationRequest;
use App\Core\Shared\Domain\PaginationResponse;

interface ItemReadRepository
{
    function findById(string $id): ?ItemViewResponse;

    function listAll(PaginationRequest $request): PaginationResponse;

    function listByProductId(PaginationRequest $request, string $productId): PaginationResponse;

    function listByInventoryId(PaginationRequest $request, string $inventoryId): PaginationResponse;
}
