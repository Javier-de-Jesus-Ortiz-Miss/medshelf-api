<?php

namespace App\Core\House\Application\Port;

use App\Core\House\Application\Dto\Response\HouseViewResponse;
use App\Core\House\Application\Dto\Response\PlaceResponse;

interface HouseReadRepository
{
    function findById(string $id): ?HouseViewResponse;

    /**
     * @param string $houseId
     * @return PlaceResponse[]
     */
    function listPlaces(string $houseId): array;
}
