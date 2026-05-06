<?php

namespace App\Core\Home\House\Application\Mapping;

use App\Core\Home\House\Application\Dto\Response\PlaceResponse;
use App\Core\Home\House\Model\Place;

final class HouseMapper
{
    private function __construct()
    {
    }

    public static function toPlaceResponse(Place $place): PlaceResponse
    {
        return new PlaceResponse(
            id: $place->getId(),
            houseId: $place->getHouseId(),
            name: $place->getName(),
            createdAt: $place->getCreatedAt(),
        );
    }
}
