<?php

namespace App\Core\Home\House\Model\Service;

use App\Core\Home\House\Model\Place;
use App\Core\Home\House\Model\Repository\PlaceRepository;
use App\Core\Home\Storage\Model\Repository\StorageRepository;
use App\Core\Home\Storage\Model\Storage;

final readonly class PlaceCreator
{
    public function __construct(
        private PlaceRepository   $placeRepository,
        private StorageRepository $storageUnitRepository,
        private HousePolicy       $houseService,
    )
    {
    }

    public function addPlace(string $houseId, string $placeName): Place
    {
        // Business rule validation
        $this->houseService->assertCanAddPlace($houseId, $placeName);
        return $this->create($houseId, $placeName);
    }

    public function create(string $houseId, string $placeName): Place
    {
        // Create the place
        $place = Place::create($houseId, $placeName);
        $this->placeRepository->save($place);

        //Create initial storage
        $storageUnit = Storage::create($place->getId(), 'Default Storage');
        $this->storageUnitRepository->save($storageUnit);
        return $place;
    }
}