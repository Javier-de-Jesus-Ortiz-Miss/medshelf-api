<?php

namespace App\Core\House\Application\Port;

use App\Core\House\Application\Dto\Response\PlaceViewResponse;

interface PlaceReadRepository
{
    function findById(string $id): ?PlaceViewResponse;

    /**
     * @param string $houseId
     * @return PlaceViewResponse[]
     */
    function list(string $houseId): array;
}
