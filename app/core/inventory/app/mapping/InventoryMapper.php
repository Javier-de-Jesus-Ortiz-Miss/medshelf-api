<?php

namespace App\core\inventory\app\mapping;

use App\core\inventory\app\dto\response\InventoryResponse;
use App\core\inventory\model\Inventory;

final class InventoryMapper
{
    private function __construct()
    {
    }

    public static function toInventoryResponse(Inventory $inventory): InventoryResponse
    {
        return new InventoryResponse(
            id: $inventory->getId(),
            ownerId: $inventory->getOwnerId(),
            name: $inventory->getName(),
        );
    }
}
