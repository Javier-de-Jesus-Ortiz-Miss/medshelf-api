<?php

namespace App\Core\House\Application\UseCase;

use App\Core\House\Application\Dto\Request\UpdatePlaceRequest;
use App\Core\House\Application\Dto\Response\PlaceResponse;
use App\Core\House\Application\Mapping\HouseMapper;
use App\Core\House\Model\HouseRepository;
use InvalidArgumentException;

final readonly class UpdatePlace
{
    public function __construct(
        private HouseRepository $repository
    )
    {
    }

    public function execute(UpdatePlaceRequest $request): PlaceResponse
    {
        $house = $this->repository->findById($request->houseId) ??
            throw new InvalidArgumentException('House not found for owner id: ' . $request->houseId);
        $place = $house->findPlace($request->placeId) ??
            throw new InvalidArgumentException('Place not found for place id: ' . $request->placeId);
        $place->changeName($request->name);
        $this->repository->save($house);
        return HouseMapper::toPlaceResponse($place);
    }
}
