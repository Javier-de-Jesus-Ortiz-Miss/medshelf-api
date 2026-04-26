<?php

namespace App\Core\House\Application\UseCase;

use App\Core\House\Application\Dto\Request\RemovePlacesRequest;
use App\Core\House\Model\HouseRepository;
use InvalidArgumentException;

final readonly class RemovePlaces
{

    public function __construct(
        private HouseRepository $repository
    )
    {
    }

    public function execute(RemovePlacesRequest $request): void
    {
        $house = $this->repository->findById($request->houseId) ??
            throw new InvalidArgumentException('House not found for owner id: ' . $request->houseId);
        $placesIds = $request->placeIds;
        foreach ($placesIds as $placeId) {
            $house->removePlace($placeId);
        }
        $this->repository->save($house);
    }
}
