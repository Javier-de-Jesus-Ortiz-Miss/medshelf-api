<?php

namespace App\Core\House\Application\Port;

use App\Core\House\Application\Dto\Response\HouseViewResponse;

interface HouseReadRepository
{
    public function findById(string $id): ?HouseViewResponse;
}
