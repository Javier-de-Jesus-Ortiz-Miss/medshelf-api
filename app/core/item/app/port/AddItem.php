<?php

namespace App\core\item\app\port;

use App\core\item\app\dto\request\AddItemRequest;
use App\core\item\app\dto\response\ItemResponse;

interface AddItem
{
    public function execute(AddItemRequest $request): ItemResponse;
}
