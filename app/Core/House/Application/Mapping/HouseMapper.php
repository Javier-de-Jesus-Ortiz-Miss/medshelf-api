<?php

namespace App\Core\Storage\App\Mapping;

use App\Core\House\Application\Dto\Response\HouseResponse;
use App\Core\House\Model\House;

final class HouseMapper
{
    private function __construct()
    {
    }

    public static function toHouseResponse(House $house): HouseResponse
    {
        $places = array_map(
            fn($room) => $room->name,
            $house->getPlaces()
        );

        return new HouseResponse(
            id: $house->getId(),
            ownerId: $house->getOwnerId(),
            name: $house->getName(),
            places: $places,
            createdAt: $house->getCreatedAt()
        );
    }
}
