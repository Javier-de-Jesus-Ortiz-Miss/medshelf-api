<?php

namespace App\Core\House\Application\Port;

use App\Core\House\Application\Dto\Request\UpdatePlaceRequest;
use App\Core\House\Application\Dto\Response\PlaceResponse;

interface UpdatePlace
{
    public function execute(UpdatePlaceRequest $request): PlaceResponse;
}
