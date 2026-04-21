<?php

namespace App\core\item\app\port;

use App\core\item\app\dto\response\ItemViewResponse;
use App\core\shared\domain\PaginationRequest;
use App\core\shared\domain\PaginationResponse;

interface ItemReadRepository
{
    function findById(string $id): ?ItemViewResponse;

    function listAll(PaginationRequest $request): PaginationResponse;

    function listByProductId(PaginationRequest $request, string $productId): PaginationResponse;

    function listByInventoryId(PaginationRequest $request, string $inventoryId): PaginationResponse;
}
