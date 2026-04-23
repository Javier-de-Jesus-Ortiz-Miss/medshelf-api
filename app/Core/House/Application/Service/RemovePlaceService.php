<?php

namespace App\Core\House\Application\Service;

use App\Core\House\Application\Dto\Request\RemovePlaceRequest;
use App\Core\House\Application\Port\RemovePlace;
use App\Core\House\Model\HouseRepository;
use InvalidArgumentException;

final readonly class RemovePlaceService implements RemovePlace
{
    private function __construct(
        private HouseRepository $houseRepository
    )
    {
    }

    public function execute(RemovePlaceRequest $request): void
    {
        $house = $this->houseRepository->findById($request->houseId) ??
            throw new InvalidArgumentException('House not found for owner id: ' . $request->houseId);
        $house->removePlace($request->placeId);
        $this->houseRepository->save($house);
    }
}
