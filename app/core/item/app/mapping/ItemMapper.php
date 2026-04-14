<?php

namespace App\core\item\app\mapping;

use App\core\item\app\dto\response\ItemResponse;
use App\core\item\model\Item;

final class ItemMapper
{
    private function __construct()
    {
    }

    public static function toItemResponse(Item $inventoryItem): ItemResponse
    {
        return new ItemResponse(
            id: $inventoryItem->getId(),
            productId: $inventoryItem->getProductId(),
            inventoryId: $inventoryItem->getInventoryId(),
            totalQuantity: $inventoryItem->getTotalQuantity(),
            quantity: $inventoryItem->getQuantity(),
            expirationDate: $inventoryItem->getExpirationDate(),
            addedDate: $inventoryItem->getAddedDate()
        );
    }
}
