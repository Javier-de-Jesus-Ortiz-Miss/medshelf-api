<?php

namespace App\Core\Home\House\Model\Exception;

use App\Core\Home\House\Model\Service\HousePolicy;
use App\Core\Shared\Domain\DomainException;

class PlaceException extends DomainException
{

    public static function cannotAddPlaceToHouseWithTooManyPlaces(string $houseId): self
    {
        return new self('Cannot add place to house with id: ' . $houseId . ' because it already has ' . HousePolicy::MAX_PLACES . ' places.');
    }

    public static function cannotAddPlaceWithSameNameInHouse(string $houseId): self
    {
        return new self('Cannot add place to house with id: ' . $houseId . ' because another place with the same name already exists in this house.');
    }

    public static function cannotRemoveMoreThanMaxPlacesFromHouse(string $houseId): self
    {
        return new self('Cannot remove more than ' . HousePolicy::MAX_PLACES . ' places from house with id: ' . $houseId . '.');
    }

    public static function cannotRemoveMorePlacesThanHouseHas(string $houseId): self
    {
        return new self('Cannot remove more places than house with id: ' . $houseId . ' has.');
    }

    public static function cannotRemovePlaceFromHouseWithOnlyOnePlace(string $houseId): self
    {
        return new self('Cannot remove place from house with id: ' . $houseId . ' because it only has one place.');
    }

    public static function cannotUpdatePlaceNameToSameNameInHouse(string $houseId): self
    {
        return new self('Cannot update place name in house with id: ' . $houseId . ' because another place with the same name already exists in this house.');
    }
}