<?php

namespace App\Core\Item\Application\Mapping;

use App\Core\Item\Application\Dto\Response\ConsumptionResponse;
use App\Core\Item\Application\Dto\Response\MedicalItemResponse;
use App\Core\Item\Model\Consumption;
use App\Core\Item\Model\MedicalItem;

final class MedicalItemMapper
{
    private function __construct()
    {
    }

    public static function toItemResponse(MedicalItem $medicalItem, string $placeId): MedicalItemResponse
    {
        return new MedicalItemResponse(
            id: $medicalItem->getId(),
            medicalProductId: $medicalItem->getMedicalProductId(),
            placeId: $placeId,
            totalQuantity: $medicalItem->getTotalQuantity(),
            availableQuantity: $medicalItem->getAvailableQuantity(),
            expirationDate: $medicalItem->getExpirationDate(),
            addedDate: $medicalItem->getAddedDate()
        );
    }

    public static function toConsumptionResponse(Consumption $consumption): ConsumptionResponse
    {
        return new ConsumptionResponse(
            id: $consumption->getId(),
            medicalItemId: $consumption->getMedicalItemId(),
            amount: $consumption->getAmount(),
            consumptionDate: $consumption->getConsumptionDate()
        );
    }
}
