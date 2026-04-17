<?php

namespace App\Core\House\Application\Port;

use App\Core\House\Application\Dto\Request\ModifyPlacesRequest;
use App\Core\House\Application\Dto\Response\HouseResponse;

interface AddPlaces
{
    public function execute(ModifyPlacesRequest $request): HouseResponse;
}
