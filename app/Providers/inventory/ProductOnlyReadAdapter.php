<?php

namespace App\Providers\inventory;

use App\core\inventory\app\port\ProductOnlyRead;
use App\core\shared\domain\PaginationRequest;
use App\core\shared\domain\PaginationResponse;
use App\Providers\mocks\inventory\ProductStorage;

class ProductOnlyReadAdapter implements ProductOnlyRead
{

    function listAll(PaginationRequest $request): PaginationResponse
    {
        $totalCount = count(ProductStorage::$storage);
        $totalPages = (int)ceil($totalCount / $request->size);
        $hasNextPage = $request->page < $totalPages;
        $items = array_slice(ProductStorage::$storage, ($request->page - 1) * $request->size, $request->size);
        return new PaginationResponse($totalCount, $totalPages, $hasNextPage, $items);
    }
}
