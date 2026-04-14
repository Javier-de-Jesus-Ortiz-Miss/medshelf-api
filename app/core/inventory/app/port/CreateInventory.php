<?php

namespace App\core\inventory\app\port;

use App\core\inventory\app\dto\request\CreateInventoryRequest;
use App\core\inventory\app\dto\response\InventoryResponse;

interface CreateInventory
{
    public function execute(CreateInventoryRequest $request): InventoryResponse;
}
