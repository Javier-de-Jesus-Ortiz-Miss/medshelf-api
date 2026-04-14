<?php

namespace App\Providers\item;

use App\core\item\app\dto\response\ItemViewResponse;
use App\core\item\app\port\ItemReadRepository;
use App\core\shared\domain\PaginationRequest;
use App\core\shared\domain\PaginationResponse;

class ItemReadRepositoryAdapter implements ItemReadRepository
{
    function findById(string $id): ?ItemViewResponse
    {
        return null;
    }

    function listAll(PaginationRequest $request): PaginationResponse
    {
        return new PaginationResponse(
            totalCount: 0,
            totalPages: 0,
            hasNextPage: 0,
            items: []
        );
    }

    function listByProductId(PaginationRequest $request, string $productId): PaginationResponse
    {
        return new PaginationResponse(
            totalCount: 0,
            totalPages: 0,
            hasNextPage: 0,
            items: []
        );
    }

    function listByInventoryId(PaginationRequest $request, string $inventoryId): PaginationResponse
    {
        return new PaginationResponse(
            totalCount: 0,
            totalPages: 0,
            hasNextPage: 0,
            items: []
        );
    }
}
