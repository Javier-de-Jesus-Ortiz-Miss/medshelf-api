<?php

namespace App\Core\House\Application\Service;

use App\Core\House\Application\Dto\Request\CreateHouseRequest;
use App\Core\House\Application\Dto\Response\HouseResponse;
use App\Core\House\Application\Mapping\HouseMapper;
use App\Core\House\Application\Port\CreateHouse;
use App\Core\House\Model\House;
use App\Core\House\Model\HouseRepository;

final readonly class CreateHouseService implements CreateHouse
{
    public function __construct(
        private HouseRepository $houseRepository
    )
    {
    }

    public function execute(CreateHouseRequest $request): HouseResponse
    {
        $house = House::create($request->ownerId, $request->name);
        $this->houseRepository->save($house);

        return HouseMapper::toHouseResponse($house);
    }
}
