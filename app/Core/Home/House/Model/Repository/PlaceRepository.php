<?php

namespace App\Core\Home\House\Model\Repository;

use App\Core\Home\House\Model\Place;

interface PlaceRepository
{
    public function save(Place $place): void;

    public function findByIdAndHouseId(string $placeId, string $houseId): ?Place;

    public function existByPlaceIdAndHouseId(string $placeId, string $houseId): bool;

    public function remove(Place $place): void;

    /**
     * @param Place[] $places
     * @return void
     */
    public function removeMany(array $places): void;

    /** @return Place[] */
    public function findByIdsAndHouseId(array $placeIds, string $houseId): array;
}
