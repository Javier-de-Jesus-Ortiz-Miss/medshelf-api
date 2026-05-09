<?php

namespace App\Core\Home\House\Application\UseCase;

use App\Core\Home\House\Application\Dto\Request\RemovePlaceRequest;
use App\Core\Home\House\Application\Exception\PlaceNotFound;
use App\Core\Home\House\Model\Repository\PlaceRepository;
use App\Core\Home\House\Model\Service\HousePolicy;

final readonly class RemovePlace
{
    public function __construct(
        private PlaceRepository $placeRepository,
        private HousePolicy     $houseService,
    )
    {
    }

    public function execute(RemovePlaceRequest $request): void
    {
        $place = $this->placeRepository->findByIdAndHouseId($request->placeId, $request->houseId) ??
            throw new PlaceNotFound($request->placeId);
        $this->houseService->assertCanRemovePlace($place->getHouseId());
        $this->placeRepository->remove($place);
    }
}
