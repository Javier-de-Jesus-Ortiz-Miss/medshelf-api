<?php

namespace App\Core\House\Application\Port;

use App\Core\House\Application\Dto\Request\CreateHouseRequest;
use App\Core\House\Application\Dto\Response\HouseResponse;

interface CreateHouse
{
    public function execute(CreateHouseRequest $request): HouseResponse;
}
