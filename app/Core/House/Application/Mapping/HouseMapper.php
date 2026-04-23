<?php

namespace App\Core\House\Application\Mapping;

use App\Core\House\Application\Dto\Response\HouseResponse;
use App\Core\House\Application\Dto\Response\PlaceResponse;
use App\Core\House\Model\House;
use App\Core\House\Model\Place;

final class HouseMapper
{
    private function __construct()
    {
    }

    public static function toHouseResponse(House $house): HouseResponse
    {
        return new HouseResponse(
            id: $house->getId(),
            ownerId: $house->getOwnerId(),
            name: $house->getName(),
            createdAt: $house->getCreatedAt()
        );
    }

    public static function toPlaceResponse(Place $place): PlaceResponse
    {
        return new PlaceResponse(
            id: $place->getId(),
            houseId: $place->getHouseId(),
            name: $place->getName(),
        );
    }
}
