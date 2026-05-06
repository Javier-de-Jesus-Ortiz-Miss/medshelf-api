<?php

namespace App\Providers\Core\Home\Storage;

use App\Core\Home\Storage\Model\Repository\StorageRepository;
use App\Core\Home\Storage\Model\Storage;
use App\Models\PlaceModel;
use App\Models\StorageModel;
use App\Providers\Core\InfrastructureException;

class StorageRepositoryAdapter implements StorageRepository
{

    public function save(Storage $storageUnit): void
    {
        $placeInternarId = PlaceModel::where('public_id', $storageUnit->getPlaceId())->value('id')
            ?? throw new InfrastructureException(sprintf('Place with id %s not found', $storageUnit->getPlaceId()));
        StorageModel::updateOrCreate(
            ['public_id' => $storageUnit->getId()],
            [
                'place_id' => $placeInternarId,
                'name' => $storageUnit->getName(),
            ]
        );
    }

    public function getDefaultStorageForPlace(string $placeId, string $houseId): ?Storage
    {
        $storage = StorageModel::whereHas('place', function ($query) use ($placeId, $houseId) {
            $query->where('public_id', $placeId)
                ->whereHas('house', function ($query) use ($houseId) {
                    $query->where('public_id', $houseId);
                });
        })->first();

        if (!$storage) {
            return null;
        }

        return Storage::load(
            id: $storage->public_id,
            placeId: $placeId,
            name: $storage->name,
            createdAt: $storage->created_at
        );
    }
}