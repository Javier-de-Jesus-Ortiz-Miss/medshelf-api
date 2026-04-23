<?php

namespace App\Core\House\Application\Port;

use App\Core\House\Application\Dto\Response\PlaceResponse;

interface PlaceReadRepository
{
    function findById(string $id): ?PlaceResponse;

    /**
     * @param string $houseId
     * @return PlaceResponse[]
     */
    function list(string $houseId): array;
}
