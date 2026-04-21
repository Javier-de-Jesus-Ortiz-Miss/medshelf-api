<?php

namespace App\Core\Item\Application\Mapping;

use App\Core\Item\Application\Dto\Response\MedicalItemResponse;
use App\Core\Item\Model\MedicalItem;

final class MedicalItemMapper
{
    private function __construct()
    {
    }

    public static function toItemResponse(MedicalItem $inventoryItem): MedicalItemResponse
    {
        return new MedicalItemResponse(
            id: $inventoryItem->getId(),
            medicalProductId: $inventoryItem->getMedicalProductId(),
            storageUnitId: $inventoryItem->getStorageUnitId(),
            totalQuantity: $inventoryItem->getTotalQuantity(),
            availableQuantity: $inventoryItem->getAvailableQuantity(),
            expirationDate: $inventoryItem->getExpirationDate(),
            addedDate: $inventoryItem->getAddedDate()
        );
    }
}
