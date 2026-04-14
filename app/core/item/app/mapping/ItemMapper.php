<?php

namespace App\core\item\app\mapping;

use App\core\item\app\dto\response\ItemResponse;
use App\core\item\model\Item;

class ItemMapper
{
    private function __construct()
    {
    }

    public static function toItemResponse(Item $inventoryItem): ItemResponse
    {
        return new ItemResponse(
            $inventoryItem->getId(),
            $inventoryItem->getProductId(),
            $inventoryItem->getInventoryId(),
            $inventoryItem->getTotalQuantity(),
            $inventoryItem->getQuantity(),
            $inventoryItem->getExpirationDate(),
            $inventoryItem->getAddedDate()
        );
    }
}
