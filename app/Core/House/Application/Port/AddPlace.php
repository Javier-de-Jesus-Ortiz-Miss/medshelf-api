<?php

namespace App\Core\House\Application\Port;

use App\Core\House\Application\Dto\Request\AddPlaceRequest;
use App\Core\House\Application\Dto\Response\PlaceResponse;

interface AddPlace
{
    public function execute(AddPlaceRequest $request): PlaceResponse;
}
