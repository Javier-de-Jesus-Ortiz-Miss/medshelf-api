<?php

namespace App\Core\Home\House\Application\UseCase;

use App\Core\Home\House\Application\Dto\Request\RemovePlacesRequest;
use App\Core\Home\House\Application\Exception\PlaceNotFound;
use App\Core\Home\House\Model\Repository\PlaceRepository;
use App\Core\Home\House\Model\Service\HousePolicy;

final readonly class RemovePlaces
{

    public function __construct(
        private PlaceRepository $placeRepository,
        private HousePolicy     $houseService,
    )
    {
    }

    public function execute(RemovePlacesRequest $request): void
    {
        $places = $this->placeRepository->findByIdsAndHouseId($request->placeIds, $request->houseId);
        $count = count($places);
        if ($count !== count($request->placeIds)) {
            throw PlaceNotFound::somePlacesNotFound();
        }
        $this->houseService->assertCanRemovePlaces($request->houseId, $count);
        $this->placeRepository->removeMany($places);
    }
}
