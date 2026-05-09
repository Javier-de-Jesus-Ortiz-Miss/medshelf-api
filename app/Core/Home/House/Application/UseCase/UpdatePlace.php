<?php

namespace App\Core\Home\House\Application\UseCase;

use App\Core\Home\House\Application\Dto\Request\UpdatePlaceRequest;
use App\Core\Home\House\Application\Dto\Response\PlaceResponse;
use App\Core\Home\House\Application\Exception\PlaceNotFound;
use App\Core\Home\House\Application\Mapping\HouseMapper;
use App\Core\Home\House\Model\Repository\PlaceRepository;
use App\Core\Home\House\Model\Service\HousePolicy;

final readonly class UpdatePlace
{
    public function __construct(
        private PlaceRepository $placeRepository,
        private HousePolicy     $houseService,
    )
    {
    }

    public function execute(UpdatePlaceRequest $request): PlaceResponse
    {
        $place = $this->placeRepository->findByIdAndHouseId($request->placeId, $request->houseId) ??
            throw new PlaceNotFound($request->placeId);
        $this->houseService->assertCanUpdatePlace($request->houseId, $request->placeId, $request->name);
        $place->changeName($request->name);
        $this->placeRepository->save($place);
        return HouseMapper::toPlaceResponse($place);
    }
}
