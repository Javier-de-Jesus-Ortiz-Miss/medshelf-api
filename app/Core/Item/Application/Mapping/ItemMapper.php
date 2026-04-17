<?php

namespace App\Core\Item\Application\Mapping;

use App\Core\Item\Application\Dto\Response\ItemResponse;
use App\Core\Item\Model\Item;

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
