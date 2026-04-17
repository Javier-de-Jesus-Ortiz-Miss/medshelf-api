<?php

namespace App\Core\House\Application\Service;

use App\Core\House\Application\Dto\Request\ModifyPlacesRequest;
use App\Core\House\Application\Dto\Response\HouseResponse;
use App\Core\House\Application\Port\AddPlaces;
use App\Core\House\Model\HouseRepository;
use App\Core\Shared\Domain\Place;
use App\Core\Storage\App\Mapping\HouseMapper;
use InvalidArgumentException;

final readonly class AddPlacesService implements AddPlaces
{

    public function __construct(
        private HouseRepository $repository
    )
    {
    }

    public function execute(ModifyPlacesRequest $request): HouseResponse
    {
        $house = $this->repository->findByOwnerId($request->ownerId) ??
            throw new InvalidArgumentException('House not found for owner id: ' . $request->ownerId);
        $placesNames = $request->placesNames;
        if (!$placesNames) {
            throw new InvalidArgumentException('Place names is required');
        }
        if (is_string($placesNames)) {
            $placeName = trim($placesNames);
            $place = Place::create($placeName);
            $house->addPlace($place);
        }
        if (is_array($placesNames)) {
            foreach ($placesNames as $placeName) {
                $placeName = trim($placeName);
                $place = Place::create($placeName);
                $house->addPlace($place);
            }
        }
        $this->repository->save($house);
        return HouseMapper::toHouseResponse($house);
    }
}
