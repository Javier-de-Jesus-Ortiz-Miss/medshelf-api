<?php

namespace App\Core\House\Application\Service;

use App\Core\House\Application\Dto\Request\AddPlaceRequest;
use App\Core\House\Application\Dto\Response\PlaceResponse;
use App\Core\House\Application\Mapping\HouseMapper;
use App\Core\House\Application\Port\AddPlace;
use App\Core\House\Model\HouseRepository;
use App\Core\House\Model\Place;
use InvalidArgumentException;

final readonly class AddPlaceService implements AddPlace
{

    public function __construct(
        private HouseRepository $repository
    )
    {
    }

    public function execute(AddPlaceRequest $request): PlaceResponse
    {
        $house = $this->repository->findById($request->houseId) ??
            throw new InvalidArgumentException('House not found for owner id: ' . $request->houseId);
        $place = Place::create($request->houseId, $request->name);
        $house->addPlace($place);
        $this->repository->save($house);
        return HouseMapper::toPlaceResponse($place);
    }
}
