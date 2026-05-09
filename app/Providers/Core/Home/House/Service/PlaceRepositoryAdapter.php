<?php

namespace App\Providers\Core\Home\House\Service;

use App\Core\Home\House\Model\Place;
use App\Core\Home\House\Model\Repository\PlaceRepository;
use App\Models\HouseModel;
use App\Models\PlaceModel;
use App\Providers\Core\InfrastructureException;

class PlaceRepositoryAdapter implements PlaceRepository
{

    public function save(Place $place): void
    {
        $houseInternalId = HouseModel::where('public_id', $place->getHouseId())->value('id')
            ?? throw new InfrastructureException(sprintf('House with id %s not found', $place->getHouseId()));

        PlaceModel::updateOrCreate(
            ['public_id' => $place->getId()],
            [
                'house_id' => $houseInternalId,
                'name' => $place->getName(),
            ]
        );
    }

    public function findByIdAndHouseId(string $placeId, string $houseId): ?Place
    {
        $record = PlaceModel::with(['house' => fn($q) => $q->select('id', 'public_id')])
            ->where('public_id', $placeId)
            ->whereHas('house', fn($q) => $q->where('public_id', $houseId))
            ->first();
        if (!$record) return null;
        return $this->toDomain($record);
    }

    private function toDomain(PlaceModel $place): Place
    {
        return Place::load(
            id: $place->public_id,
            houseId: $place->house->public_id,
            name: $place->name,
            createdAt: $place->created_at,
        );
    }

    public function existByPlaceIdAndHouseId(string $placeId, string $houseId): bool
    {
        return PlaceModel::where('public_id', $placeId)
            ->whereHas('house', fn($q) => $q->where('public_id', $houseId))
            ->exists();
    }

    public function remove(Place $place): void
    {
        PlaceModel::where('public_id', $place->getId())
            ->whereHas('house', fn($q) => $q->where('public_id', $place->getHouseId()))
            ->delete();
    }

    public function removeMany(array $places): void
    {
        $placeIds = array_map(fn(Place $place) => $place->getId(), $places);
        PlaceModel::whereIn('public_id', $placeIds)
            ->whereHas('house', fn($q) => $q->whereIn('public_id', array_map(fn(Place $place) => $place->getHouseId(), $places)))
            ->delete();
    }

    public function findByIdsAndHouseId(array $placeIds, string $houseId): array
    {
        return PlaceModel::with(['house' => fn($q) => $q->select('id', 'public_id')])
            ->whereIn('public_id', $placeIds)
            ->whereHas('house', fn($q) => $q->where('public_id', $houseId))
            ->get()
            ->map(fn(PlaceModel $record) => $this->toDomain($record))
            ->toArray();
    }
}
