<?php

namespace App\Providers\Core\House;

use App\Core\House\Application\Dto\Data\HouseResume;
use App\Core\House\Application\Dto\Response\PlaceViewResponse;
use App\Core\House\Application\Port\PlaceReadRepository;
use App\Models\PlaceModel;

class PlaceReadRepositoryAdapter implements PlaceReadRepository
{


    public function findById(string $id): ?PlaceViewResponse
    {
        $record = PlaceModel::with(['house' => fn($q) => $q->select('id', 'public_id', 'name')])
            ->where('public_id', $id)
            ->first();
        if (!$record) return null;
        return $this->toView($record);
    }

    private function toView(PlaceModel $record): PlaceViewResponse
    {
        $house = $record->house;
        return new PlaceViewResponse(
            id: $record->public_id,
            house: new HouseResume(
                $house->public_id,
                $house->name
            ),
            name: $record->name
        );
    }

    public function list(string $houseId): array
    {
        return PlaceModel::with(['house' => fn($q) => $q->select('id', 'public_id', 'name')])
            ->whereHas('house', fn($q) => $q->where('public_id', $houseId))
            ->get()
            ->map(fn(PlaceModel $record) => $this->toView($record))
            ->toArray();
    }
}
