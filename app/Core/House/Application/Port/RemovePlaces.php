<?php

namespace App\Core\House\Application\Port;

use App\Core\House\Application\Dto\Request\RemovePlacesRequest;

interface RemovePlaces
{
    public function execute(RemovePlacesRequest $request): void;
}
