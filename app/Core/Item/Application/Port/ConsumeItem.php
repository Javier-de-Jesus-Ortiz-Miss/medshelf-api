<?php

namespace App\Core\Item\Application\Port;

use App\Core\Item\Application\Dto\Request\ConsumeItemRequest;
use App\Core\Item\Application\Dto\Response\ItemResponse;

interface ConsumeItem
{
    public function execute(ConsumeitemRequest $request): ItemResponse;
}
