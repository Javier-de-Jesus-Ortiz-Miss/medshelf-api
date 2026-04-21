<?php

namespace App\core\inventory\app\port;

use App\core\inventory\app\dto\request\ModifyInventoryRequest;
use App\core\inventory\app\dto\response\InventoryResponse;

interface ModifyInventory
{
    public function execute(ModifyInventoryRequest $request): InventoryResponse;
}
