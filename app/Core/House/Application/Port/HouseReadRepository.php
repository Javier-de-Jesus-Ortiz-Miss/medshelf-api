<?php

namespace App\Core\House\Application\Port;

use App\Core\House\Application\Dto\Response\HouseResponse;

interface HouseReadRepository
{
    function findById(string $id): ?HouseResponse;
}
