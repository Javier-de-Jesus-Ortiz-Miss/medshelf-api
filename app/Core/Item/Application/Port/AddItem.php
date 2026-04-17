<?php

namespace App\Core\Item\Application\Port;

use App\Core\Item\Application\Dto\Request\AddItemRequest;
use App\Core\Item\Application\Dto\Response\ItemResponse;

interface AddItem
{
    public function execute(AddItemRequest $request): ItemResponse;
}
