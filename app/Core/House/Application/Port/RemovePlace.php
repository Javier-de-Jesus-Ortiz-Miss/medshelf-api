<?php

namespace App\Core\House\Application\Port;

use App\Core\House\Application\Dto\Request\RemovePlaceRequest;

interface RemovePlace
{
    public function execute(RemovePlaceRequest $request): void;
}
