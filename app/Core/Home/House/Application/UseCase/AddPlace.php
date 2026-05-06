<?php

namespace App\Core\Home\House\Application\UseCase;

use App\Core\Home\House\Application\Dto\Request\AddPlaceRequest;
use App\Core\Home\House\Application\Dto\Response\PlaceResponse;
use App\Core\Home\House\Application\Mapping\HouseMapper;
use App\Core\Home\House\Model\Service\PlaceCreator;

final readonly class AddPlace
{

    public function __construct(
        private PlaceCreator $placeCreator,
    )
    {
    }

    public function execute(AddPlaceRequest $request): PlaceResponse
    {
        return HouseMapper::toPlaceResponse(
            $this->placeCreator->addPlace($request->houseId, $request->name)
        );
    }
}
