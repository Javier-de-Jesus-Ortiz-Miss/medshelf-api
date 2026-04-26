<?php

namespace App\Providers\Core\House;

use App\Core\House\Model\House;
use App\Core\House\Model\HouseRepository;
use App\Core\House\Model\Place;
use App\Models\HouseModel;
use App\Models\User;
use InvalidArgumentException;

class HouseRepositoryAdapter implements HouseRepository
{

    public function findById(string $id): ?House
    {
        $record = HouseModel::with([
            'owner' => fn($q) => $q->select('id', 'public_id'),
            'places' => fn($q) => $q->select('id', 'public_id', 'house_id', 'name'),
        ])
            ->where('public_id', $id)
            ->first();
        if (!$record) return null;
        return $this->toDomain($record);
    }

    private function toDomain(HouseModel $houseModel): House
    {
        return House::load(
            id: $houseModel->public_id,
            ownerId: $houseModel->owner->public_id,
            name: $houseModel->name,
            places: $houseModel->places->map(fn($place) => Place::load(
                id: $place->public_id,
                houseId: $houseModel->public_id,
                name: $place->name
            ))->toArray(),
            createdAt: $houseModel->created_at
        );
    }

    public function save(House $house): void
    {
        $ownerId = User::where('public_id', $house->getOwnerId())->value('id')
            ?? throw new InvalidArgumentException('Owner not found');
        HouseModel::updateOrCreate(
            ['public_id' => $house->getId()],
            [
                'owner_id' => $ownerId,
                'name' => $house->getName(),
            ]
        );
    }

    public function exists(string $id): bool
    {
        return HouseModel::where('public_id', $id)->exists();
    }
}
