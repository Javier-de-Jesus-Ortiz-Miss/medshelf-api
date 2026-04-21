<?php

namespace App\core\inventory\app\dto\response;

readonly class InventoryResponse
{
    public function __construct(
        public string $id,
        public string $ownerId,
        public string $name
    )
    {
    }
}
