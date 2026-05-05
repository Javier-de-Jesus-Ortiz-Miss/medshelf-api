<?php

namespace App\Core\Home\Item\Application\Mapping;

use App\Core\Home\Item\Application\Dto\Response\ConsumptionResponse;
use App\Core\Home\Item\Application\Dto\Response\ItemResponse;
use App\Core\Home\Item\Model\Consumption;
use App\Core\Home\Item\Model\Item;

final class ItemMapper
{
    private function __construct()
    {
    }

    public static function toItemResponse(Item $item, string $placeId): ItemResponse
    {
        return new ItemResponse(
            id: $item->getId(),
            productId: $item->getProductId(),
            placeId: $placeId,
            totalContent: $item->getTotalContent(),
            expirationDate: $item->getExpirationDate(),
            createdAt: $item->getCreatedAt()
        );
    }

    public static function toConsumptionResponse(Consumption $consumption): ConsumptionResponse
    {
        return new ConsumptionResponse(
            id: $consumption->getId(),
            itemId: $consumption->getItemId(),
            amount: $consumption->getAmount(),
            consumedAt: $consumption->getConsumedAt()
        );
    }
}
